<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public $showingCheckout = false;
    public $price;

    public function render()
    {
        return view('livewire.checkout');
    }
}
