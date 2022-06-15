<?php

namespace App\Http\Livewire\Admin;

use App\Models\CanteenStoreName;
use App\Models\Profile;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminEditSellerComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $seller_id;
    public $shopname;
    public $slug;
    public $mobile;
    public $address;

    public function mount($seller_id)
    {
        $this->seller_id = $seller_id;
        $seller = User::where('id', $seller_id)->first();
        $this->name = $seller->name;
        $this->email = $seller->email;
        $this->shopname = $seller->store->name;
        $this->slug = $seller->store->slug;
        $this->mobile = $seller->profile->mobile;
        $this->address = $seller->profile->address;
    }
    public function generateSlug()
    {
        $this->slug = Str::slug($this->shopname, '-');
    }
    public function editSeller()
    {
        $seller = User::find($this->seller_id);
        $seller->name = $this->name;
        $seller->email = $this->email;
        $seller->save();

        $store = CanteenStoreName::find($this->seller_id);
        $store->name = $this->shopname;
        $store->slug = $this->slug;
        $store->save();

        $profile = Profile::find($this->seller_id);
        $profile->mobile = $this->mobile;
        $profile->address = $this->address;
        $profile->save();

        session()->flash('message', 'Seller [ ' . $this->seller_id . ' ] has been updated successfully !');
        return redirect()->route('admin.sellers');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-seller-component')->layout('layouts.admin-dashboard');
    }
}
