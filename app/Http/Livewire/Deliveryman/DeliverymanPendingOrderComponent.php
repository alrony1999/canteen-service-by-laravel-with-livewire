<?php

namespace App\Http\Livewire\Deliveryman;

use App\Models\OrderItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeliverymanPendingOrderComponent extends Component
{
    public function updateDeliverymanStatus($order_id, $ststus)
    {
        $order = OrderItem::find($order_id);
        $order->deliverman_id = Auth::user()->id;
        if ($ststus == 'delivered') {
            $order->order_status = $ststus;
        }
        $order->deliveryman_status = $ststus;
        $order->save();
        if ($ststus == 'delivered') {
            $transaction = Transaction::find($order_id);
            $transaction->status = 'received';
            $transaction->save();
        }

        session()->flash('order_message', 'Order status has been updated successfully');
    }
    public function render()
    {
        $todayorder = OrderItem::where('deliverman_id', Auth::user()->id)->where('deliveryman_status', '=', 'delivered')->whereDate('created_at', Carbon::today())->count();
        $mypendingdelivery = OrderItem::where('deliverman_id', Auth::user()->id)->where('deliveryman_status', '!=', 'delivered')->get();
        return view('livewire.deliveryman.deliveryman-pending-order-component', ['mypendingdelivery' => $mypendingdelivery, 'todayorder' => $todayorder])->layout('layouts.deliveryman-dashboard');
    }
}
