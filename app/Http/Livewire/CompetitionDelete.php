<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompetitionDelete extends Component
{
    public $competition;
    public $confirmingCompetitionDeletion;
    public $refresh;

    public function delete()
    {
        $this->competition->calendarItem->delete();
        $this->competition->delete();

        if ($this->refresh) {
            $this->emitTo('competitions-list', 'refresh');
        } else {
            return redirect()->route('competitions');
        }
    }

    public function render()
    {
        return view('livewire.competition-delete');
    }
}
