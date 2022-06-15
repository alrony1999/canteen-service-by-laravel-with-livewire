<?php

namespace App\Http\Livewire\Seller;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SellerOrdersComponent extends Component
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

        $allordersn = OrderItem::where('store_id', Auth::user()->store->id)->count();
        $allorders = OrderItem::where('store_id', Auth::user()->store->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.seller.seller-orders-component', ['allorders' => $allorders, 'allordersn' => $allordersn])->layout('layouts.seller-dashboard');
    }
}
