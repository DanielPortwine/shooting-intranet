<?php

namespace App\Http\Livewire;

use App\Models\Competition;
use Livewire\Component;

class CompetitionShow extends Component
{
    public $competition;
    protected $listeners = ['refresh' => 'mount'];

    public function mount($competitionID): void
    {
        $this->competition = Competition::with(['user'])
            ->where('id', $competitionID)
            ->first();
    }

    public function render()
    {
        return view('livewire.competition-show');
    }
}
