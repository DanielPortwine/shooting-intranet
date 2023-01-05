<?php

namespace App\Http\Livewire;

use App\Models\Stage;
use Livewire\Component;

class StageShow extends Component
{
    public $stage;
    public $showingTargetScoresCreate;
    protected $listeners = ['refresh' => '$refresh'];

    public function mount($stageID): void
    {
        $this->stage = Stage::where('id', $stageID)
            ->first();
    }

    public function render()
    {
        return view('livewire.stage-show');
    }
}
