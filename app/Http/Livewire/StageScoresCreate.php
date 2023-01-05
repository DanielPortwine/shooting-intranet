<?php

namespace App\Http\Livewire;

use App\Models\Target;
use App\Models\TargetTypeScore;
use Livewire\Component;

class StageScoresCreate extends Component
{
    public $stage;
    public $time;
    public $targets = [];
    public $shooter;
    public $cleanTime;
    public $penalties;
    public $no_score = false;
    public $showingStageScoresCreate;

    protected $rules = [
        'time' => ['nullable', 'required_unless:no_score,true', 'numeric'],
        'targets.*.shots' => ['array'],
        'targets.*.shots.*' => ['nullable', 'integer'],
        'no_score' => ['boolean'],
    ];

    public function updatedTime()
    {
        $this->cleanTime = str_replace('.', '', $this->time);
        $this->time = decimalise($this->cleanTime);
    }

    public function createTargetScores()
    {
        $this->validate();

        if (!$this->no_score) {
            $scores = $this->stage->competition->targetType->scores;

            $points = 0;
            foreach ($this->targets as $id => $shots) {
                $records = [];
                foreach ($shots as $score => $count) {
                    TargetTypeScore::where('score', $score)->first()->id;
                    for ($x = 0; $x < (int)$count; $x++) {
                        $records[] = [
                            'user_id' => $this->shooter->id,
                            'target_id' => $id,
                            'score_id' => $scores->where('score', $score)->first()->id,
                        ];
                        $points += $scores->where('score', $score)->first()->value;
                    }
                }

                $target = Target::with(['type', 'type.scores', 'scores'])->where('id', $id)->first();
                $target->scores()->createMany($records);
            }

            $score = $points;
            $score -= $this->penalties * 5;
            $score -= (float)$this->time * 0.15;
        } else {
            $points = null;
            $this->penalties = null;
            $score = null;
        }

        $this->stage->shooters()->attach($this->shooter, ['time' => $this->cleanTime, 'points' => $points, 'penalties' => $this->penalties * 5, 'score' => $score]);

        $this->showingStageScoresCreate = false;
        $this->time = '';
        $this->targets = [];
        $this->emitTo('stage-shooters-show', 'refresh');
    }

    public function render()
    {
        return view('livewire.stage-scores-create');
    }
}
