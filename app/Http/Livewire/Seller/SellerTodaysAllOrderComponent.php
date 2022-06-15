<?php

namespace App\Http\Livewire\Seller;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SellerTodaysAllOrderComponent extends Component
{
    public function render()
    {
        $orders = OrderItem::where('store_id', Auth::user()->store->id)->orderBy('created_at', 'DESC')->whereDate('created_at', Carbon::today())->paginate(10);
        $totalorder = OrderItem::where('store_id', Auth::user()->store->id)->where('order_status', '!=', 'cancelled')->whereDate('created_at', Carbon::today())->count();
        // $totalSales = OrderItem::where('store_id', Auth::user()->store->id)->where('order_status', 'delivered')->orWhere('deliveryman_status', 'delivered')->whereDate('created_at', Carbon::today())->sum('total');
        // // $cancelorder = OrderItem::where('store_id', Auth::user()->store->id)->where('order_status', 'canceled')->whereDate('created_at', Carbon::today())->count();
        // $pickup = OrderItem::where('store_id', Auth::user()->store->id)->where('order_mode', 'pick-up')->where('order_status', 'delivered')->whereDate('created_at', Carbon::today())->count();
        // $delivery = OrderItem::where('store_id', Auth::user()->store->id)->where('order_mode', 'delivery')->where('deliveryman_status', 'delivered')->whereDate('created_at', Carbon::today())->count();
        return view(
            'livewire.seller.seller-todays-all-order-component',
            [
                'orders' => $orders,
                // 'totalSales' => $totalSales,
                'totalorder' => $totalorder,
                // 'pickup' => $pickup,
                // 'delivery' => $delivery
            ]
        )->layout('layouts.seller-dashboard');
    }
}
