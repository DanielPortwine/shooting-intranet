<div>
    <x-jet-dropdown-link wire:click.prevent="$toggle('confirmingVisitDeletion')" wire:loading.attr="disabled" class="cursor-pointer text-red-500">
        {{ __('Delete') }}
    </x-jet-dropdown-link>
    <x-jet-confirmation-modal wire:model="confirmingVisitDeletion">
        <x-slot name="title">
            {{ __('Delete Visit') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this visit? Once a visit is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingVisitDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Visit') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>