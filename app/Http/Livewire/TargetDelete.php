<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TargetDelete extends Component
{
    public $target;
    public $confirmingTargetDeletion;

    public function deleteTarget()
    {
        $this->target->delete();

        $this->emitTo('visit-show', 'refresh', $this->target->visit_id);
    }

    public function render()
    {
        return view('livewire.target-delete');
    }
}
