<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;
use Exception;
use Stripe;

class CheckoutComponent extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $address;

    public $paymentmode;
    public $ordermode;

    public $thankyou;

    public $card_no;
    public $exp_month;
    public $exp_year;
    public $cvc;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        if (Auth::user()->profile) {
            $this->mobile = Auth::user()->profile->mobile;
            $this->address = Auth::user()->profile->address;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'paymentmode' => 'required',
            'ordermode' => 'required'
        ]);
        if ($this->paymentmode == 'card') {
            $this->validateOnly($fields, [
                'card_no' => 'required|numeric',
                'exp_month' => 'required|numeric',
                'exp_year' => 'required|numeric',
                'cvc' => 'required|numeric',
            ]);
        }
    }
    public function placeOrder()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'paymentmode' => 'required',
            'ordermode' => 'required'
        ]);
        if ($this->paymentmode == 'card') {
            $this->validate([
                'card_no' => 'required|numeric',
                'exp_month' => 'required|numeric',
                'exp_year' => 'required|numeric',
                'cvc' => 'required|numeric',
            ]);
        }

        if ($this->paymentmode == 'cod') {
            foreach (Cart::instance('cart')->content() as $item) {

                $orderItem = new OrderItem();
                $orderItem->user_id = Auth::user()->id;
                $orderItem->food_id = $item->id;
                $orderItem->store_id = $item->model->store_id;
                $orderItem->price = $item->price;
                $orderItem->quantity = $item->qty;
                $orderItem->discount = session()->get('checkout')['discount'];
                $orderItem->tax = session()->get('checkout')['tax'];
                $orderItem->total = $item->price * $item->qty;
                $orderItem->name = $this->name;
                $orderItem->email = $this->email;
                $orderItem->mobile = $this->mobile;
                $orderItem->address = $this->address;
                $orderItem->order_mode = $this->ordermode;
                $orderItem->order_status = 'ordered';
                $orderItem->save();
                $this->makeTransaction($orderItem->id,  $item->model->store_id, $item->price * $item->qty, 'pending');
            }

            $this->resetCart();
        } else if ($this->paymentmode == 'card') {

            $stripe = Stripe::make(env('STRIPE_KEY'));
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $this->card_no,
                        'exp_month' => $this->exp_month,
                        'exp_year' => $this->exp_year,
                        'cvc' => $this->cvc
                    ]
                ]);
                if (!isset($token['id'])) {
                    session()->flash('stripe_error', 'The stripe token was not generated !');
                    $this->thankyou = 0;
                }
                $customer = $stripe->customers()->create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->mobile,
                    'address' => [
                        'line1' => $this->address,
                        'postal_code' => 1204,
                        'city' => 'Dhaka',
                        'state' => '',
                        'country' => 'Bangladesh'
                    ],
                    'shipping' => [
                        'name' => $this->name,
                        'address' => [
                            'line1' => $this->address,
                            'postal_code' => 1204,
                            'city' => 'Dhaka',
                            'state' => '',
                            'country' => 'Bangladesh'
                        ],

                    ],
                    'source' => $token['id']

                ]);

                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'CNY',
                    'amount' => session()->get('checkout')['total'],
                    'description' => 'Payment successful  '
                ]);
                if ($charge['status'] == 'succeeded') {
                    foreach (Cart::instance('cart')->content() as $item) {
                        $orderItem = new OrderItem();
                        $orderItem->user_id = Auth::user()->id;
                        $orderItem->food_id = $item->id;
                        $orderItem->store_id = $item->model->store_id;
                        $orderItem->price = $item->price;
                        $orderItem->quantity = $item->qty;
                        $orderItem->discount = session()->get('checkout')['discount'];
                        $orderItem->tax = session()->get('checkout')['tax'];
                        $orderItem->total = $item->price * $item->qty;
                        $orderItem->name = $this->name;
                        $orderItem->email = $this->email;
                        $orderItem->mobile = $this->mobile;
                        $orderItem->address = $this->address;
                        $orderItem->order_mode = $this->ordermode;
                        $orderItem->order_status = 'ordered';
                        $orderItem->save();
                        $this->makeTransaction($orderItem->id,  $item->model->store_id, $item->price * $item->qty, 'received');
                    }
                    $this->resetCart();
                } else {
                    session()->flash('stripe_error', 'Error in Transaction !');
                    $this->thankyou = 0;
                }
            } catch (Exception $e) {
                session()->flash('stripe_error', $e->getMessage());
                $this->thankyou = 0;
            }
        }
    }
    public function resetCart()
    {
        $this->thankyou = 1;
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }
    public function makeTransaction($order_id, $store_id, $total, $status)
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $this->paymentmode;
        $transaction->status = $status;
        $transaction->store_id = $store_id;
        $transaction->price = $total;
        $transaction->save();
    }
    public function verifyForCheckOut()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else if ($this->thankyou) {
            return redirect()->route('thankyou');
        } else if (!session()->get('checkout')) {
            return redirect()->route('food.cart');
        }
    }
    public function render()
    {
        $this->verifyForCheckOut();
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
