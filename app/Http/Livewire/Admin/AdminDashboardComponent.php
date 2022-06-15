<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Food;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class AdminDashboardComponent extends Component
{
    public function render()
    {
        $food = Food::count();
        $category = Category::count();
        $seller = User::where('utype', 'S')->count();
        $deliveryman = User::where('utype', 'D')->count();
        $customer = User::where('utype', 'C')->count();
        return view('livewire.admin.admin-dashboard-component', [
            'food' => $food,
            'category' => $category,
            'seller' => $seller,
            'deliveryman' => $deliveryman,
            'customer' => $customer
        ])->layout('layouts.admin-dashboard');
    }
}
