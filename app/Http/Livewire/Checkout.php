<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public $showingCheckout = false;
    public $price;

    public function close()
    {
        $this->showingCheckout = false;

        $this->emitTo('outstanding-payments', 'refresh');
        $this->emitTo('active-payments', 'refresh');
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
