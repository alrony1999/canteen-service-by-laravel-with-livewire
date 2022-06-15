<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class AdminEditDeliverymenComponent extends Component
{
    public $name;
    public $email;
    public $password;
    public $deliveryman_id;
    public $mobile;
    public $address;

    public function mount($deliveryman_id)
    {
        $this->deliveryman_id = $deliveryman_id;
        $deliveryman = User::where('id', $deliveryman_id)->first();
        $this->name = $deliveryman->name;
        $this->email = $deliveryman->email;
        $this->password = $deliveryman->password;
        $this->mobile = $deliveryman->profile->mobile;
        $this->address = $deliveryman->profile->address;
    }
    public function editDeliveryman()
    {
        $deliveryman = User::find($this->deliveryman_id);
        $deliveryman->name = $this->name;
        $deliveryman->email = $this->email;
        $deliveryman->save();
        $deliveryman->profile->mobile = $this->mobile;
        $deliveryman->profile->address = $this->address;
        $deliveryman->profile->save();

        session()->flash('message', 'Deliveryman [ ' . $this->deliveryman_id . ' ] has been updated successfully !');
        return redirect()->route('admin.deliverymen');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-deliverymen-component')->layout('layouts.admin-dashboard');
    }
}
