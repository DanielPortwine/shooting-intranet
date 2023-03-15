<?php

namespace App\Console\Commands;

use App\Models\Package;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\MembershipRenewal;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateRenewalPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:create-renewals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run through any recurring packages and generate payments';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with(['packages' => function ($query) {
            return $query->where('recurring', 'annually');
        }])->whereHas('packages', function ($query) {
            return $query->where('recurring', 'annually');
        })->get();

        foreach ($users as $user) {
            $payments = [];
            foreach ($user->packages as $package) {
                if (
                    Carbon::parse($package->recurring_start_date)->subMonth()->month !== Carbon::now()->month ||
                    Carbon::parse($package->recurring_start_date)->day !== Carbon::now()->day
                ) {
                    continue;
                }

                $price = $package->price;
                if ($package->pro_rata && $package->charge_full_first) {
                    $now = Carbon::now();
                    $pastPayments = $package->payments->where('user_id', $user->id);
                    if ($pastPayments->count() === 1) {
                        $firstDate = Carbon::parse($pastPayments->first()->created_at);
                        $price = round(($package->price / 12) * $now->diffInMonths($firstDate), 2);
                    }
                }

                $payments[] = Payment::create([
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'price' => $price,
                    'due_date' => $package->recurring_start_date->format(Carbon::now()->year.'-m-d'),
                    'reminder_date' => Carbon::parse($package->recurring_start_date)->subWeek()->format(Carbon::now()->year.'-m-d'),
                ]);
            }

            if (count($payments) > 0) {
                $user->notify(new MembershipRenewal($payments));
            }
        }

        return Command::SUCCESS;
    }
}
