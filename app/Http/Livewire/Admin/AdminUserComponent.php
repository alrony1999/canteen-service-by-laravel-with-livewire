<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class AdminUserComponent extends Component
{
    public $search;
    public function deleteUser($id)
    {
        $product = User::find($id);
        $product->delete();
        session()->flash('message', 'User [' . $id . ' ] has been deleted successfully !');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $users = User::where('id', 'LIKE', $search)->where('utype', 'C')->paginate(100);
        return view('livewire.admin.admin-user-component', ['users' => $users])->layout('layouts.admin-dashboard');
    }
}
