<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StageCard extends Component
{
    public $stage;
    protected $listeners = ['refresh' => '$refresh'];

    public function show()
    {
        return redirect()->route('stage-show', $this->stage->id);
    }

    public function render()
    {
        return view('livewire.stage-card');
    }
}
