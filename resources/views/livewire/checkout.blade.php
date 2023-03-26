<div>
    <x-jet-button wire:click="$toggle('showingCheckout')" wire:loading.attr="disabled">
        {{ __('Pay') }}
    </x-jet-button>
    <x-jet-dialog-modal wire:model="showingCheckout" maxWidth="sm">
        <x-slot name="title">
            Pay Securely
        </x-slot>

        <x-slot name="content">
            <x-jet-label>Amount</x-jet-label>
            <h3 class="text-xl font-semibold mb-4">£{{ $price }}</h3>

            <!-- Stripe Elements Placeholder -->
            <div id="card-element" class="mt-2" wire:ignore></div>
            <div id="card-errors" class="mt-2 text-sm text-red-400"></div>
            <p class="mt-2">{{ $paymentStatus }}</p>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click.prevent="$emit('payNow')" id="card-button">
                Pay Now
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let cardElement;
        let stripe;

        function createCardElement() {
            const elements = stripe.elements();
            cardElement = elements.create('card');
            cardElement.mount('#card-element');
        }

        function removeCardElement() {
            cardElement.unmount();
        }

        document.addEventListener('DOMContentLoaded', function () {
            stripe = Stripe('{{ config('services.stripe.public_key') }}');
            createCardElement();

            window.livewire.on('payNow', () => {
                stripe.createToken(cardElement).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        window.livewire.emit('processPayment', result.token);
                        document.getElementById('card-button').setAttribute('disabled', true);
                    }
                });
            });

            window.livewire.on('renderCardElement', () => {
                removeCardElement();
                createCardElement();
            });

            window.livewire.on('processPayment', (token) => {
                @this.processPayment(token);
            });
        });
    </script>
@endpush
