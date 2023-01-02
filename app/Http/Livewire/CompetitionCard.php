<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompetitionCard extends Component
{
    public $competition;
    protected $listeners = ['refresh' => '$refresh'];

    public function show()
    {
        return redirect()->route('competition-show', $this->competition->id);
    }

    public function render()
    {
        return view('livewire.competition-card');
    }
}
