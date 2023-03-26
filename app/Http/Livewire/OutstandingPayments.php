<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OutstandingPayments extends Component
{
    public $user;
    public $payments;
    protected $listeners = ['refresh' => 'mount'];

    public function mount()
    {
        $this->user = Auth::user();
        $this->payments = $this->user->payments->whereNull('paid_at');
        $this->emitTo('checkout', 'priceUpdated', $this->payments->sum('price'));
    }

    public function render()
    {
        return view('livewire.outstanding-payments');
    }
}
