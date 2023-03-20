<?php

namespace App\Http\Livewire;

use App\Models\Package;
use Livewire\Component;

class PackageCancel extends Component
{
    public $package;
    public $user;
    public $confirmingPackageCancellation = false;

    public function cancel()
    {
        $outstandingPayments = $this->user->payments->where('package_id', $this->package->id);

        foreach ($outstandingPayments as $payment) {
            $payment->delete();
        }

        $this->user->packages()->detach($this->package);

        $this->emitTo('active-packages', 'refresh');
        $this->emitTo('select-packages', 'refresh');
        $this->emitTo('outstanding-payments', 'refresh');

        $this->confirmingPackageCancellation = false;
    }

    public function render()
    {
        return view('livewire.package-cancel');
    }
}
