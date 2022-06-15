<?php

namespace App\Http\Livewire;

use App\Models\Food;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function store($food_id, $food_name, $food_price)
    {
        Cart::instance('cart')->add($food_id, $food_name, 1, $food_price, [], 0)->associate('App\Models\Food');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_message', 'Item added in Cart');
    }

    public function render()
    {
        $food = Food::where('slug', $this->slug)->first();
        $popular_foods = Food::inRandomOrder()->limit(4)->get();
        $related_foods = Food::where('category_id', $food->category_id)->inRandomOrder()->limit(5)->get();
        return view('livewire.details-component', ['food' => $food, 'popular_foods' => $popular_foods, 'related_foods' => $related_foods])->layout('layouts.base');
    }
}
