<div>
    <x-jet-dropdown-link wire:click.prevent="$toggle('confirmingTargetDeletion')" wire:loading.attr="disabled" class="text-red-500 cursor-pointer">
        {{ __('Delete') }}
    </x-jet-dropdown-link>
    <x-jet-confirmation-modal wire:model="confirmingTargetDeletion">
        <x-slot name="title">
            {{ __('Delete Target') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this target? Once a target is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingTargetDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="deleteTarget" wire:loading.attr="disabled">
                {{ __('Delete Target') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
