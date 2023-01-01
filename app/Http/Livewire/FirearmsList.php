<?php

namespace App\Http\Livewire;

use App\Models\Firearm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FirearmsList extends Component
{
    public $firearms;
    protected $listeners = ['refresh' => 'mount'];

    public function mount(): void
    {
        $this->firearms = Firearm::with(['user', 'checkIns'])
            ->where('user_id', Auth::id())
            ->orderBy('fac_number')
            ->get();
    }

    public function render()
    {
        return view('livewire.firearms-list');
    }
}
