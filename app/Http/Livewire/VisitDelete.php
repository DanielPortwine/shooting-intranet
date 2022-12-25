<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VisitDelete extends Component
{
    public $visit;
    public $confirmingVisitDeletion;
    public $refresh;

    public function delete()
    {
        $this->visit->delete();

        if ($this->refresh) {
            $this->emitTo('visits-list', 'refresh');
        } else {
            return redirect()->route('visits');
        }
    }

    public function render()
    {
        return view('livewire.visit-delete');
    }
}
