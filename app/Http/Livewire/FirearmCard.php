<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FirearmCard extends Component
{
    public $firearm;
    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        return view('livewire.firearm-card');
    }
}
