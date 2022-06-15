<?php

namespace App\Http\Livewire\Seller;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SellerTodaysDeliveryTypeOrderComponent extends Component
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
        $delivery = OrderItem::where('store_id', Auth::user()->store->id)->where('order_mode', 'delivery')->where('order_status', '!=', 'cancelled')->where('order_status', '!=', 'delivered')->whereDate('created_at', Carbon::today())->count();
        $delivery_orders = OrderItem::where('store_id', Auth::user()->store->id)->where('order_mode', '=', 'delivery')->where('order_status', '!=', 'cancelled')->where('order_status', '!=', 'delivered')->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.seller.seller-todays-delivery-type-order-component', ['delivery_orders' => $delivery_orders, 'delivery' => $delivery])->layout('layouts.seller-dashboard');
    }
}
