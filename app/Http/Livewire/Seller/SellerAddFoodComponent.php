<?php

namespace App\Http\Livewire\Seller;

use App\Models\Category;
use App\Models\Food;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Image;

use Livewire\WithFileUploads;

class SellerAddFoodComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    public $images;

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
    }
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }
    public function update($field)
    {
        $this->validateOnly($field, [
            'name' => 'required|max:15',
            'short_description' => 'required|max:30',
            'description' => 'required|max:50',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png|dimensions:min_width=800,min_height=800',
            'category_id' => 'required'
        ]);
    }
    public function addFood($store_id)
    {
        $this->validate([
            'name' => 'required|max:15',
            'short_description' => 'required|max:30',
            'description' => 'required|max:50',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png|dimensions:min_width=800,min_height=800',
            'category_id' => 'required'

        ]);

        $food = new Food();
        $food->name = $this->name;
        $food->slug = Str::slug($this->name, '-');
        $food->short_description = $this->short_description;
        $food->description = $this->description;
        $food->regular_price = $this->regular_price;
        $food->sale_price = $this->sale_price;
        $food->sale_price = $this->sale_price;
        $food->SKU = $this->SKU;
        $food->stock_status = $this->stock_status;
        $food->featured = $this->featured;
        $food->quantity = $this->quantity;

        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $image_resize = Image::make($this->image->getRealPath());
        $image_resize->resize(500, 500);
        $image_resize->save(public_path('assets/images/foods/' . $imageName));
        $food->image = $imageName;
        if ($this->images) {
            $imagesname = null;
            foreach ($this->images as $key => $image) {

                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(500, 500);
                $image_resize->save(public_path('assets/images/foods/' . $imgName));
                if ($imagesname) {
                    $imagesname = $imagesname . ',' . $imgName;
                } else {
                    $imagesname = $imgName;
                }
            }
            $food->images = $imagesname;
        }
        $food->category_id = $this->category_id;
        $food->store_id = $store_id;
        $food->save();
        session()->flash('message', 'Food has been added successfully !');
        return redirect()->route('seller.foods');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.seller-add-food-component', ['categories' => $categories])->layout('layouts.seller-dashboard');
    }
}
