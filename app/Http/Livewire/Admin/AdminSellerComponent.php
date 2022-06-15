<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSellerComponent extends Component
{
    use WithPagination;
    public $search;
    public function deleteSeller($id)
    {
        $product = User::find($id);
        $product->delete();
        session()->flash('message', 'Seller [' . $id . ' ] has been deleted successfully !');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $sellers = User::where('name', 'LIKE', $search)->where('utype', 'S')->paginate(10);
        return view('livewire.admin.admin-seller-component', ['sellers' => $sellers])->layout('layouts.admin-dashboard');
    }
}
