<?php

namespace App\Http\Livewire;

use App\Models\Target;
use App\Models\TargetScore;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TargetScoresCreate extends Component
{
    public $target;
    public $showingTargetScoresCreate = false;
    public $shots;

    protected $rules = [
        'shots' => ['array'],
        'shots.*' => ['nullable', 'integer'],
    ];

    public function createTargetScores()
    {
        $this->validate();

        $records = [];
        $totalScore = 0;

        foreach ($this->target->type->scores as $score) {
            if (array_key_exists($score->score, $this->shots)) {
                for ($x = 0; $x < (int)$this->shots[$score->score]; $x++) {
                    $records[] = [
                        'target_id' => $this->target->id,
                        'score_id' => $score->id,
                    ];
                    $totalScore += $score->score;
                }
            }
        }

        $this->target->scores()->createMany($records);

        $this->showingTargetScoresCreate = false;
        $this->shots = [];
        $this->emitTo('target-card', 'refresh');
    }

    public function render()
    {
        return view('livewire.target-scores-create');
    }
}
