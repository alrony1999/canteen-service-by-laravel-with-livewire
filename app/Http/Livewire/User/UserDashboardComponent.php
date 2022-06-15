<?php

namespace App\Http\Livewire\User;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserDashboardComponent extends Component
{

    public function render()
    {

        $orders = OrderItem::orderBy('created_at', 'DESC')->where('user_id', Auth::user()->id)->paginate(10);
        $totalCost = OrderItem::where('user_id', Auth::user()->id)->where('order_status', '=', 'delivered')->sum('total');
        $totalPurchase = OrderItem::where('order_status', '!=', 'canceled')->where('user_id', Auth::user()->id)->count();
        $totalDelivered = OrderItem::where('order_status', 'delivered')->where('user_id', Auth::user()->id)->count();
        $totalCanceled = OrderItem::where('order_status', 'canceled')->where('user_id', Auth::user()->id)->count();



        return view('livewire.user.user-dashboard-component', [
            'orders' => $orders,
            'totalCost' => $totalCost,
            'totalPurchase' => $totalPurchase,
            'totalDelivered' => $totalDelivered,
            'totalCanceled' => $totalCanceled
        ])->layout('layouts.base');
    }
}
