<?php

namespace App\Http\Livewire\Seller;

use App\Models\Category;
use App\Models\Food;
use Carbon\Carbon;
use Faker\Core\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Image;

class SellerEditFoodComponent extends Component
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
    public $newimage;
    public $food_id;

    public $images;
    public $newimages;

    public function mount($food_slug)
    {
        $food = Food::where('slug', $food_slug)->first();
        $this->name = $food->name;
        $this->slug = $food->slug;
        $this->short_description = $food->short_description;
        $this->description = $food->description;
        $this->regular_price = $food->regular_price;
        $this->sale_price = $food->sale_price;
        $this->SKU = $food->SKU;
        $this->stock_status = $food->stock_status;
        $this->featured = $food->featured;
        $this->quantity = $food->quantity;

        $this->image = $food->image;
        $this->category_id = $food->category_id;
        $this->product_id = $food->id;

        $this->images = explode(",", $food->images);
    }
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }
    public function update($field)
    {
        $this->validateOnly($field, [
            'name' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',

            'category_id' => 'required'
        ]);
        if ($this->newimage) {
            $this->validateOnly($field, [
                'newimage' => 'required|mimes:jpeg,png|dimensions:min_width=800,min_height=800',
            ]);
        }
    }
    public function updateFood()
    {
        $this->validate([
            'name' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'required'

        ]);
        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:jpeg,png|dimensions:min_width=800,min_height=800',
            ]);
        }
        $food = Food::find($this->product_id);
        $food->name = $this->name;
        $food->slug = $this->slug;
        $food->short_description = $this->short_description;
        $food->description = $this->description;
        $food->regular_price = $this->regular_price;
        $food->sale_price = $this->sale_price;
        $food->sale_price = $this->sale_price;
        $food->SKU = $this->SKU;
        $food->stock_status = $this->stock_status;
        $food->featured = $this->featured;
        $food->quantity = $this->quantity;
        if ($this->newimage) {
            if (Storage::exists('assets/images/foods' . '/' . $this->image)) {
                unlink('assets/images/foods' . '/' . $this->image);
            }

            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $image_resize = Image::make($this->imageName->getRealPath());
            $image_resize->resize(800, 800);
            $image_resize->save(public_path('assets/images/foods/' . $imageName));
            $food->image = $imageName;
        }
        if ($this->newimages) {
            if ($this->images) {
                $images = explode(",", $food->images);

                foreach ($images as $image) {
                    if ($image && Storage::exists('assets/images/foods' . '/' . $image)) {
                        unlink('assets/images/foods' . '/' . $image);
                    }
                }
            }

            $imagesname = null;
            foreach ($this->newimages as $key => $image) {
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
        $food->save();
        session()->flash('message', 'Food [' . $food->id . ' ] has been updated successfully !');
        return redirect()->route('seller.foods');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.seller-edit-food-component', ['categories' => $categories])->layout('layouts.seller-dashboard');
    }
}
