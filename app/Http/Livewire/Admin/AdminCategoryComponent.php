<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;
    public $search;
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('message', 'Category [' . $id . '] has been deleted successfully !');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $categories = Category::where('id', 'LIKE', $search)
            ->orWhere('name', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.admin-category-component', ['categories' => $categories])->layout('layouts.admin-dashboard');
    }
}
