<?php

namespace App\Http\Livewire;

use App\Models\Competition;
use Livewire\Component;

class CompetitionsList extends Component
{
    public $competitions;
    protected $listeners = ['refresh' => 'mount'];

    public function mount(): void
    {
        $this->competitions = Competition::with(['user'])->orderByDesc('created_at')->limit('10')->get();
    }

    public function render()
    {
        return view('livewire.competitions-list');
    }
}
