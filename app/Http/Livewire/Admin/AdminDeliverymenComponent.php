<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDeliverymenComponent extends Component
{
    use WithPagination;
    public $search;
    public function deleteDeliveryman($id)
    {
        $product = User::find($id);
        $product->delete();
        session()->flash('message', 'Deliveryman [' . $id . ' ] has been deleted successfully !');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $deliveryman = User::where('name', 'LIKE', $search)->where('utype', 'D')->paginate(10);
        return view('livewire.admin.admin-deliverymen-component', ['deliverymen' => $deliveryman])->layout('layouts.admin-dashboard');
    }
}
