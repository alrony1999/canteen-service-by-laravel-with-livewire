<?php

namespace App\Http\Livewire\Seller;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SellerTodaysPickUpOrderComponent extends Component
{
    public function updateOrderStatus($order_id, $ststus)
    {
        $order = OrderItem::find($order_id);
        $order->order_status = $ststus;

        $order->save();
        session()->flash('order_message', 'Order status has been updated successfully');
    }
    public function render()
    {
        $pickup = OrderItem::where('store_id', Auth::user()->store->id)->where('order_mode', 'pick-up')->where('order_status', '!=', 'cancelled')->where('order_status', '!=', 'delivered')->whereDate('created_at', Carbon::today())->count();
        $pick_up_orders = OrderItem::where('store_id', Auth::user()->store->id)->where('order_mode', '=', 'pick-up')->where('order_status', '!=', 'cancelled')->where('order_status', '!=', 'delivered')->where('order_status', '!=', 'delivered')->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.seller.seller-todays-pick-up-order-component', ['pick_up_orders' => $pick_up_orders, 'pickup' => $pickup])->layout('layouts.seller-dashboard');
    }
}
