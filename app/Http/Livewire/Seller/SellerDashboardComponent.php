<?php

namespace App\Http\Livewire\Seller;

use App\Models\Food;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SellerDashboardComponent extends Component
{
    use WithPagination;
    public function updateOrderStatus($order_id, $ststus)
    {
        $order = OrderItem::find($order_id);
        $order->order_status = $ststus;

        $order->save();
        session()->flash('order_message', 'Order status has been updated successfully');
    }
    public function render()
    {
        $orders = OrderItem::where('store_id', Auth::user()->store->id)->orderBy('created_at', 'DESC')->paginate(10);
        $food = Food::count();
        $totalorder = OrderItem::where('store_id', Auth::user()->store->id)->where('order_status', 'delivered')->count();
        $totalcancellorder = OrderItem::where('store_id', Auth::user()->store->id)->where('order_status', 'cancelled')->count();
        $totalRevenue = OrderItem::where('store_id', Auth::user()->store->id)->where('order_status', 'delivered')->sum('total');
        $totalcod = OrderItem::where('store_id', Auth::user()->store->id)->where('order_status', 'delivered')->whereDate('created_at', Carbon::today())->count();
        $totalcard = OrderItem::where('store_id', Auth::user()->store->id)->where('order_status', 'delivered')->whereDate('created_at', Carbon::today())->count();
        return view(
            'livewire.seller.seller-dashboard-component',
            [
                'orders' => $orders,
                'food' => $food,
                'totalorder' => $totalorder,
                'totalRevenue' => $totalRevenue,
                'totalcod' => $totalcod,
                'totalcard' => $totalcard,
                'totalcancellorder' => $totalcancellorder
            ]
        )->layout('layouts.seller-dashboard');
    }
}
