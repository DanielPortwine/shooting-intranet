<?php

namespace App\Http\Livewire;

use App\Models\Visit;
use Livewire\Component;

class VisitShow extends Component
{
    public $visit;
    protected $listeners = ['refresh' => 'mount'];

    public function mount($visitID): void
    {
        $this->visit = Visit::with(['targets', 'targets.scores', 'targets.type', 'targets.type.scores'])
            ->where('id', $visitID)
            ->first();
    }

    public function delete()
    {
        $this->visit->delete();

        return redirect()->route('visits');
    }

    public function render()
    {
        return view('livewire.visit-show');
    }
}
