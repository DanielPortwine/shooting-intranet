<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CalendarItemDelete extends Component
{
    public $item;
    public $confirmingItemDeletion = false;

    public function delete()
    {
        $this->item->model->delete();
        $this->item->delete();
        $this->emitTo('calendar', 'generateMonth');

        $this->confirmingItemDeletion = false;
    }

    public function render()
    {
        return view('livewire.calendar-item-delete');
    }
}
