<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Membership') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                @php $payments = Auth()->user()->payments->whereNull('paid_at'); @endphp
                @if(count($payments))
                    @if(Auth()->user()->approved_at)
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
                    <p>You can pay online using your credit or debit card. Click Pay to do so.</p>
                @elseif(Auth()->user()->approved_at)
                    <p>Your membership is active and paid for. Thank you for your continued support. See below a list of your current packages.</p>
                    <ul class="list-disc list-inside">
                        @foreach(Auth()->user()->packages as $package)
                            <li>{{ $package->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Thank you for paying! Your application will be processed shortly. Once your application is approved, you will gain access to the rest of the app.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
