<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VisitCard extends Component
{
    public $visit;
    protected $listeners = ['refresh' => '$refresh'];

    public function show()
    {
        return redirect()->route('visit-show', $this->visit->id);
    }

    public function render()
    {
        return view('livewire.visit-card');
    }
}
