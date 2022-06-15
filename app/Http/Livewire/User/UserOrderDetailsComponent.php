<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserOrderDetailsComponent extends Component
{
    public $order_id;
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }
    public function cancelOrder()
    {
        $order = OrderItem::find($this->order_id);
        $order->order_status = "canceled";
        $order->save();
        session()->flash('order_message', 'Order Has been canceled');
    }
    public function render()
    {
        $order = OrderItem::where('id', $this->order_id)->first();
        return view('livewire.user.user-order-details-component', ['order' => $order])->layout('layouts.base');
    }
}
