<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CanteenComponent extends Component
{
    public function render()
    {
        return view('livewire.canteen-component')->layout('layouts.base');
    }
}
