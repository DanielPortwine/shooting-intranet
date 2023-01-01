<div>
    <x-jet-dropdown-link wire:click.prevent="$toggle('confirmingFirearmDeletion')" wire:loading.attr="disabled" class="cursor-pointer text-red-500">
        {{ __('Delete') }}
    </x-jet-dropdown-link>
    <x-jet-confirmation-modal wire:model="confirmingFirearmDeletion">
        <x-slot name="title">
            {{ __('Delete Firearm') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this firearm? Once a firearm is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingFirearmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Firearm') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
