<?php

namespace App\Http\Livewire\Seller;

use App\Models\OrderItem;
use Livewire\Component;

class SellerOrderDetailsComponent extends Component
{
    public $order_id;
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }
    public function render()
    {
        $order = OrderItem::where('id', $this->order_id)->first();

        return view('livewire.seller.seller-order-details-component', ['order' => $order])->layout('layouts.panel');
    }
}
