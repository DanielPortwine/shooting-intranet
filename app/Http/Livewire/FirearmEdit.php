<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FirearmEdit extends Component
{
    public $firearm;
    public $showingFirearmEdit = false;

    protected $rules = [
        'firearm.make' => ['string', 'max:255'],
        'firearm.model' => ['string', 'max:255'],
        'firearm.fac_number' => ['integer'],
        'firearm.serial' => ['nullable', 'string'],
    ];

    public function update()
    {
        $this->validate();

        $this->firearm->update([
            'make' => $this->firearm->make,
            'model' => $this->firearm->model,
            'fac_number' => $this->firearm->fac_number,
            'serial' => $this->firearm->serial,
        ]);

        $this->showingFirearmEdit = false;
        $this->emitTo('firearm-card', 'refresh');
    }

    public function render()
    {
        return view('livewire.firearm-edit');
    }
}
