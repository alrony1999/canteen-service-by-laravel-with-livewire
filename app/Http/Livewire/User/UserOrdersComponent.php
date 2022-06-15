<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOrdersComponent extends Component
{
    public function render()
    {
        $orders = OrderItem::orderBy('created_at', 'DESC')->where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->paginate(12);

        return view('livewire.user.user-orders-component', ['orders' => $orders])->layout('layouts.base');
    }
}
