<div>
    <x-jet-button wire:click="$toggle('showingCheckout')" wire:loading.attr="disabled">
        {{ __('Pay') }}
    </x-jet-button>
    <x-jet-dialog-modal wire:model="showingCheckout" maxWidth="sm">
        <x-slot name="title">
            Pay Securely
        </x-slot>

        <x-slot name="content">
            <div class="">
                <x-jet-label>Amount</x-jet-label>
                <h3 class="text-xl font-semibold mb-4">£{{ $price }}</h3>

                <!-- Stripe Elements Placeholder -->
                <div id="card-element"></div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button id="card-button" class="">
                Pay Now
            </x-jet-button>
            <x-jet-secondary-button id="close-button" wire:click="$toggle('showingCheckout')" wire:loading.attr="disabled" class="hidden">
                Close
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('{{ config('services.stripe.public_key') }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {
            document.getElementById('card-button').innerText = 'Processing...';
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: {}
                }
            );

            if (error) {
                //
            } else {
                axios.post('{{ route('charge') }}', {
                    amount: {{ $price * 100 }},
                    paymentMethodId: paymentMethod.id,
                })
                .then(function (response) {
                    document.getElementById('card-element').innerText ='Payment Successful!';
                    document.getElementById('card-button').classList.add('hidden');
                    document.getElementById('close-button').classList.remove('hidden');
                })
                .catch(function (error) {
                    //
                });
            }
        });
    </script>
</div>
