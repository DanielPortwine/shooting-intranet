<?php

namespace App\Http\Livewire;

use App\Models\Firearm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FirearmCreate extends Component
{
    public $make;
    public $model;
    public $fac_number;
    public $serial;
    public $showingFirearmCreate = false;

    protected $rules = [
        'make' => ['string', 'max:255'],
        'model' => ['string', 'max:255'],
        'fac_number' => ['integer'],
        'serial' => ['nullable', 'string'],
    ];

    public function createFirearm()
    {
        $this->validate();

        $firearm = Firearm::create([
            'user_id' => Auth::id(),
            'make' => $this->make,
            'model' => $this->model,
            'fac_number' => $this->fac_number,
            'serial' => $this->serial,
        ]);

        $this->showingFirearmCreate = false;
        $this->make = '';
        $this->model = '';
        $this->fac_number = '';
        $this->serial = '';
        $this->emitTo('firearms-list', 'refresh');
        $this->emitTo('firearm-create', 'created');
    }

    public function render()
    {
        return view('livewire.firearm-create');
    }
}
