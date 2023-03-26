<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class Checkout extends Component
{
    public $showingCheckout = false;
    public $price;
    public $paymentStatus;

    protected $listeners = [
        'priceUpdated' => 'updatePrice',
    ];

    public function close()
    {
        $this->showingCheckout = false;

        $this->emitTo('outstanding-payments', 'refresh');
        $this->emitTo('active-payments', 'refresh');
    }

    public function updatePrice($price)
    {
        $this->price = $price;
        $this->emit('renderCardElement');
    }

    public function processPayment($token)
    {
        $user = Auth::user();

        if (!$user->stripe_id) {
            $user->createAsStripeCustomer();
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret_key'));

            $payment = PaymentIntent::create([
                'amount' => $this->price * 100,
                'currency' => 'gbp',
                'customer' => $user->stripe_id,
                'payment_method_data' => [
                    'type' => 'card',
                    'card' => ['token' => $token['id']],
                ],
                'confirmation_method' => 'automatic',
                'confirm' => true,
            ]);

            if ($payment->status === 'succeeded') {
                $this->paymentStatus = 'Payment successful!';
                Payment::where('user_id', $user->id)->whereNull('paid_at')->update(['paid_at' => now()]);
            } else {
                $this->paymentStatus = 'Payment failed!';
            }
        } catch (\Exception $exception) {
            $this->paymentStatus = 'An error occurred!';
            Log::error(Carbon::now() . ' - Stripe exception: ' . $exception->getMessage());
        }

        $this->emitTo('outstanding-payments', 'refresh');
        $this->emitTo('select-packages', 'refresh');
        $this->emitTo('active-packages', 'refresh');
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
