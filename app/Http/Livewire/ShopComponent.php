<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use App\Models\Food;
use Cart;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $search;
    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->fill(request()->only('search'));
    }

    public function store($food_id, $food_name, $food_price)
    {
        Cart::instance('cart')->add($food_id, $food_name, 1, $food_price, [], 0)->associate('App\Models\Food');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_message', 'Item added in Cart');
    }


    public function render()
    {
        $search = '%' . $this->search . '%';
        if ($this->sorting == 'date') {
            $foods = Food::where('name', 'LIKE', $search)->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        } else if ($this->sorting == 'price') {
            $foods = Food::where('name', 'LIKE', $search)->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        } else if ($this->sorting == 'price-desc') {
            $foods = Food::where('name', 'LIKE', $search)->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else {
            $foods = Food::where('name', 'LIKE', $search)->paginate($this->pagesize);
        }

        $categories = Category::all();
        return view('livewire.shop-component', ['foods' => $foods, 'categories' => $categories])->layout('layouts.base');
    }
}
