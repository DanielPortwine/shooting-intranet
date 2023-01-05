<?php

namespace App\Http\Livewire;

use App\Models\Stage;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class StageScoresShow extends Component
{
    public $shooter;
    public $stage;
    public $stageShooter;
    public $time;
    public $score;
    public $showingStageScoresShow = false;

    public function mount(User $shooter, Stage $stage): void
    {
        $this->stageShooter = $shooter->stages()->where('stages.id', $stage->id)->first();
        $this->time = decimalise($this->stageShooter->pivot->time);
        $this->score = $this->stageShooter->pivot->score;
//        if (($timeLength = strlen((string)$this->stageShooter->pivot->time)) > 2) {
//            $this->time = substr($this->stageShooter->pivot->time, 0, $timeLength - 2) . '.' .
//                substr($this->stageShooter->pivot->time, $timeLength - 2);
//        }

//        foreach($this->stage->targets as $target) {
//            foreach ($target->scores->where('user_id', $shooter->id) as $targetScore) {
//                $this->score += $targetScore->score->value;
//            }
//        }
//        $this->score -= $this->time * 0.15;
    }

    public function render()
    {
        return view('livewire.stage-scores-show');
    }
}
