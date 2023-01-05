<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StageShootersShow extends Component
{
    public $stage;
    public $shooter;
    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        return view('livewire.stage-shooters-show');
    }
}
