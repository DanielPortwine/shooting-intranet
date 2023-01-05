<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StageDelete extends Component
{
    public $stage;
    public $confirmingStageDeletion;
    public $refresh;

    public function delete()
    {
        $this->stage->delete();

        if ($this->refresh) {
            $this->emitTo('competition-show', 'refresh', ['competitionID' => $this->stage->competition_id]);
        } else {
            return redirect()->route('competition-show', $this->stage->competition_id);
        }
    }

    public function render()
    {
        return view('livewire.stage-delete');
    }
}
