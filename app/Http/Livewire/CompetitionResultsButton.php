<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompetitionResultsButton extends Component
{
    public $competition;

    public function showResults()
    {
        return redirect()->route('competition-results', $this->competition->id);
    }

    public function render()
    {
        return view('livewire.competition-results-button');
    }
}
