<?php

namespace App\Http\Livewire\Admin;

use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddDeliverymenComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $password;
    public $image;
    public $mobile;
    public $address;


    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'password' => 'required',
            'image' => 'required'
        ]);
    }

    public function addDeliveryman()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'password' => 'required',
            'image' => 'required'
        ]);
        $deliverymaan = new User();
        $deliverymaan->name = $this->name;
        $deliverymaan->email = $this->email;
        $deliverymaan->password = Hash::make($this->password);
        $deliverymaan->utype = 'D';
        // $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        // $this->image->storeAs('deliverymen', $imageName);
        // $deliverymaan->profile_photo_path = $imageName;
        $deliverymaan->save();

        $profile = new Profile();
        $profile->mobile = $this->mobile;
        $profile->address = $this->address;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('profile', $imageName);
        $profile->image = $imageName;
        $profile->user_id = $deliverymaan->id;
        $profile->save();

        session()->flash('message', 'Deliveryman has been added successfully !');
        return redirect()->route('admin.deliverymen');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-deliverymen-component')->layout('layouts.admin-dashboard');
    }
}
