<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FirearmDelete extends Component
{
    public $firearm;
    public $confirmingFirearmDeletion;

    public function delete()
    {
        $this->firearm->delete();

        $this->emitTo('firearms-list', 'refresh');
    }

    public function render()
    {
        return view('livewire.firearm-delete');
    }
}
