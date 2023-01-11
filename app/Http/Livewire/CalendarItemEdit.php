<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CalendarItemEdit extends Component
{
    public $item;
    public $model;
    public $date;
    public $showingItemEdit = false;

    protected $rules = [
        'model.title' => ['required', 'string', 'max:255'],
        'model.description' => ['nullable', 'string', 'max:255'],
        'date' => ['required', 'date'],
        'model.private' => ['boolean'],
    ];

    public function mount(): void
    {
        $this->model = $this->item->model;
        $this->date = Carbon::parse($this->model->date)->format('Y-m-d\TH:i');
    }

    public function update()
    {
        if ($this->model->user_id !== Auth::id()) {
            return;
        }

        $oldDate = $this->model->date;

        $this->model->update([
            'title' => $this->model->title,
            'description' => $this->model->description,
            'date' => $this->date,
            'private' => $this->model->private,
        ]);

        $this->showingItemEdit = false;

        if ($this->model->date->format('Y-m-d') !== $oldDate->format('Y-m-d')) {
            $this->emitTo('calendar', 'generateMonth');
        } else {
            $this->emitUp('refresh');
        }
    }

    public function render()
    {
        return view('livewire.calendar-item-edit');
    }
}
