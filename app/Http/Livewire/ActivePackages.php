<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActivePackages extends Component
{
    public $user;
    public $packages;
    protected $listeners = ['refresh' => 'mount'];

    public function mount()
    {
        $this->user = Auth::user();
        $this->packages = $this->user->packages()->with('payments')->get();
    }

    public function render()
    {
        return view('livewire.active-packages');
    }
}
