<?php

namespace App\Http\Livewire\Seller;

use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SellerFoodComponent extends Component
{
    use WithPagination;
    public $search;
    public function deleteFood($id)
    {
        $food = Food::find($id);
        if ($food->image) {
            unlink('assets/images/foods' . '/' .  $food->image);
        }
        if ($food->images) {
            $images = explode(",", $food->images);

            foreach ($images as $image) {
                if ($image) {
                    unlink('assets/images/foods' . '/' . $image);
                }
            }
        }
        $food->delete();
        session()->flash('message', 'Food [' . $id . ' ] has been deleted successfully !');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $foods = Food::where('name', 'LIKE', $search)->where('store_id', Auth::user()->store->id)->paginate(10);
        return view('livewire.seller.seller-food-component', ['foods' => $foods])->layout('layouts.seller-dashboard');
    }
}
