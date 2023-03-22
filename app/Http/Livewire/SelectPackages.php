<?php

namespace App\Http\Livewire;

use App\Models\Package;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SelectPackages extends Component
{
    public $packages;
    public $user;
    public $selectedPackages = [];
    protected $listeners = ['refresh' => 'mount'];

    protected $rules = [
        'selectedPackages' => 'required|array',
        'selectedPackages.*' => 'required|integer|exists:packages,id',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $userPackages = $this->user->packages->pluck('id')->toArray();
        $this->packages = Package::whereNotIn('id', $userPackages)
            ->notExcluded($userPackages)
            ->notRequired($userPackages)
            ->get();
    }

    public function selectPackages()
    {
        $this->validate();

        foreach (Package::whereIn('id', $this->selectedPackages)->get() as $package) {
            if ($package->charge_full_first || !$package->pro_rata) {
                $price = $package->price;
            } else {
                $now = Carbon::now();
                switch ($package->recurring) {
                    case 'annually':
                        if (Carbon::parse($package->recurring_start_date)->month !== $now->month) {
                            $nextDate = Carbon::parse($package->recurring_start_date);
                            while ($nextDate->lt($now)) {
                                $nextDate->addYear();
                            }

                            $price = round(($package->price / 12) * $now->diffInMonths($nextDate), 2);
                        } else {
                            $price = $package->price;
                        }
                        break;
                    default:
                        $price = $package->price;

                }
            }

            $this->user->packages()->attach($package);

            Payment::create([
                'user_id' => $this->user->id,
                'package_id' => $package->id,
                'price' => $price,
            ]);

            $this->mount();
            $this->emitTo('active-packages', 'refresh');
            $this->emitTo('outstanding-payments', 'refresh');
        }
    }

    public function render()
    {
        return view('livewire.select-packages');
    }
}
