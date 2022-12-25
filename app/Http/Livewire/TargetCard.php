<?php

namespace App\Http\Livewire;

use App\Models\Target;
use Livewire\Component;

class TargetCard extends Component
{
    public $target;
    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        return view('livewire.target-card');
    }
}
