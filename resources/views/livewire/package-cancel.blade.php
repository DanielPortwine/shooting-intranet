<div>
    <button wire:click.prevent="$toggle('confirmingPackageCancellation')" wire:loading.attr="disabled" class="text-red-500 mr-2">X</button>
    <x-jet-confirmation-modal wire:model="confirmingPackageCancellation">
        <x-slot name="title">
            {{ __('Cancel Package') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to cancel this package? You will need to re-apply and pay for the package if you change your mind later.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingPackageCancellation')" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="cancel" wire:loading.attr="disabled">
                {{ __('Cancel Package') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
