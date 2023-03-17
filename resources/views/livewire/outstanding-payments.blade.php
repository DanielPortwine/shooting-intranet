<div>
    @if(count($payments))
        @if($user->approved_at)
            <p>Your membership is due for renewal. Please pay to maintain your membership.</p>
        @else
            <p>Your application has been received. Once you pay, we will begin processing it.</p>
        @endif
        <h3 class="text-lg font-semibold mt-4">Outstanding payments:</h3>
        @foreach($payments as $payment)
            <div class="flex gap-2 py-2 items-center border-b border-gray-200">
                <p class="flex-grow">{{ $payment->package->name }}</p>
                <p>£{{ $payment->price }}</p>
            </div>
        @endforeach
        <p class="font-bold text-right mt-4">Total: £{{ $payments->sum('price') }}</p>
        <div class="flex">
            <div class="flex-grow"></div>
            @livewire('checkout', ['price' => $payments->sum('price')])
        </div>
        <h3 class="text-lg font-semibold mt-4">Ways to pay:</h3>
        <h4 class="font-semibold mt-2">Bank Transfer</h4>
        <p>
            You can pay straight into our bank account using bank transfer. It can take up to 48hrs to verify your
            transfer so please only pay once and make sure you provide your reference. Use the following details:
        </p>
        <ul>
            <li>Sort Code: XX-XX-XX</li>
            <li>Account Number: XXXXXXXX</li>
            <li>Reference: {{ Auth()->user()->name }}</li>
        </ul>
        <h4 class="font-semibold mt-2">Cash</h4>
        <p>You can pay in cash at the club.</p>
        <h4 class="font-semibold mt-2">Card</h4>
        <p>You can pay online using your credit or debit card. Click Pay to do so.</p><br>
    @endif
</div>
