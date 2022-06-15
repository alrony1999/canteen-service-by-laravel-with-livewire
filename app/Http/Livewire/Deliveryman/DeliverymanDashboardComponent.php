<?php

namespace App\Http\Livewire\Deliveryman;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeliverymanDashboardComponent extends Component
{
    public function updateDeliverymanStatus($order_id, $ststus)
    {
        $order = OrderItem::find($order_id);
        $order->deliverman_id = Auth::user()->id;
        $order->deliveryman_status = $ststus;
        $order->save();
        session()->flash('order_message', 'Order status has been updated successfully');
    }
    public function render()
    {

        $myorderlist = OrderItem::where('deliverman_id', Auth::user()->id)->where('deliveryman_status', 'delivered')->paginate(10);
        $totaldelivery = OrderItem::where('deliverman_id', Auth::user()->id)->where('deliveryman_status', 'delivered')->count();
        $pendingorder = OrderItem::where('deliverman_id', Auth::user()->id)->where('deliveryman_status', '!=', 'delivered')->count();
        $todaydelivery = OrderItem::where('deliverman_id', Auth::user()->id)->where('deliveryman_status', 'delivered')->whereDate('created_at', Carbon::today())->count();
        $todayRevenue = OrderItem::where('deliverman_id', Auth::user()->id)->where('deliveryman_status', 'delivered')->whereDate('created_at', Carbon::today())->sum('total');
        return view(
            'livewire.deliveryman.deliveryman-dashboard-component',
            [
                'myorderlist' => $myorderlist,
                'totaldelivery' => $totaldelivery,
                'pendingorder' => $pendingorder,
                'todaydelivery' => $todaydelivery,
                'todayRevenue' => $todayRevenue
            ]
        )->layout('layouts.deliveryman-dashboard');
    }
}
