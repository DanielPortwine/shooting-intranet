<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function charge(Request $request)
    {
        $stripeCharge = $request->user()->charge(
            $request->amount, $request->paymentMethodId
        );

        if ($stripeCharge->status === 'succeeded') {
            Payment::where('user_id', $request->user()->id)->whereNull('paid_at')->update(['paid_at' => now()]);
        }

        return $stripeCharge;
    }
}
