<?php

namespace App\Http\Livewire;

use App\Models\Visit;
use Livewire\Component;

class VisitsList extends Component
{
    public $visits;
    protected $listeners = ['refresh' => 'mount'];

    public function mount($success = null): void
    {
        $this->visits = Visit::with(['user', 'targets', 'targets.scores'])->orderByDesc('created_at')->limit('10')->get();
    }

    public function render()
    {
        return view('livewire.visits-list');
    }
}
