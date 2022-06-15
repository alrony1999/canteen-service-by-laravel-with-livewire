<?php

namespace App\Http\Livewire\Admin;

use App\Models\CanteenStoreName;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminAddSellertComponent extends Component
{
    use WithFileUploads;
    public $mobile;
    public $address;
    public $name;
    public $email;
    public $password;
    public $image;
    public $shopname;
    public $slug;




    public function generateSlug()
    {
        $this->slug = Str::slug($this->shopname, '-');
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'password' => 'required',
            'shopname' => 'required',
            'image' => 'required'
        ]);
    }
    public function addSeller()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'password' => 'required',
            'shopname' => 'required',
            'image' => 'required'
        ]);

        $seller = new User();
        $seller->name = $this->name;
        $seller->email = $this->email;
        $seller->password = Hash::make($this->password);
        $seller->utype = 'S';
        // $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        // $this->image->storeAs('sellers', $imageName);
        // $seller->profile_photo_path = $imageName;
        $seller->save();

        $store = new CanteenStoreName();
        $store->name = $this->shopname;
        $store->slug = $this->slug;
        $store->seller_id = $seller->id;
        $store->save();

        $profile = new Profile();
        $profile->address = $this->address;
        $profile->mobile = $this->mobile;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('profile', $imageName);
        $profile->image = $imageName;
        $profile->user_id = $seller->id;
        $profile->save();
        session()->flash('message', 'Seller Details has been updated successfully !');
        return redirect()->route('admin.sellers');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-sellert-component')->layout('layouts.admin-dashboard');
    }
}
