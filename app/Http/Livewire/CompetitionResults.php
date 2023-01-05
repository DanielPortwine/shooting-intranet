<?php

namespace App\Http\Livewire;

use App\Models\Competition;
use App\Models\User;
use Livewire\Component;

class CompetitionResults extends Component
{
    public $shootersOverall;
    public $shootersStages;
    public $competition;

    public function mount(Competition $competition): void
    {
        $users = $competition->shooters()->with([
            'targetScores' => function ($query) use ($competition) {
                $query->whereIn('target_id', $competition->targets->pluck('id')->toArray());
            },
            'stages' => function ($query) use ($competition) {
                $query->whereIn('stage_id', $competition->stages->pluck('id')->toArray());
            },
        ])->get();

        $this->shootersOverall = $users->sortByDesc(function($user) {
            return $user->stages->sum('pivot.score') ?: null;
        });

        foreach ($this->competition->stages as $stage) {
//            $users = $competition->shooters()->with([
//                'targetScores' => function ($query) use ($competition) {
//                    $query->whereIn('target_id', $competition->targets->pluck('id')->toArray());
//                },
//                'stages' => function ($query) use ($competition) {
//                    $query->whereIn('stage_id', $competition->stages->pluck('id')->toArray());
//                },
//            ])->get();

            $usersStage = $users->where('stages.id', $stage->id);

            $this->shootersStages[$stage->id] = $usersStage->sortByDesc(function($user) {
                return $user->stages->pivot->score;
            });
        }
    }

    public function render()
    {
        return view('livewire.competition-results');
    }
}
