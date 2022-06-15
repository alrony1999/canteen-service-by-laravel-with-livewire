<?php

namespace App\Http\Livewire\Deliveryman;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeliverymanLatestOrderComponent extends Component
{
    public function updateDeliverymanStatus($order_id, $status)
    {

        $order = OrderItem::find($order_id);
        $order->deliverman_id = Auth::user()->id;
        $order->deliveryman_status = $status;
        $order->save();
        session()->flash('order_message', 'Order status has been updated successfully');
    }
    public function render()
    {
        $orders = OrderItem::where('order_mode', '=', 'delivery')
            ->where('order_status', '!=', 'ordered')
            ->where('deliveryman_status', '=', 'no')
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'DESC')->paginate(30);
        $mypendingdelivery = OrderItem::where('deliverman_id', Auth::user()->id)->where('deliveryman_status', '!=', 'delivered')->count();
        return view('livewire.deliveryman.deliveryman-latest-order-component', ['orders' => $orders, 'mypendingdelivery' => $mypendingdelivery])->layout('layouts.deliveryman-dashboard');
    }
}
