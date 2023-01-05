<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompetitionEntryCreate extends Component
{
    public $competition;

    public function enter()
    {
        $this->competition->shooters()->attach(Auth::id());
    }

    public function cancel()
    {
        $this->competition->shooters()->detach(Auth::id());
    }

    public function render()
    {
        return view('livewire.competition-entry-create');
    }
}
