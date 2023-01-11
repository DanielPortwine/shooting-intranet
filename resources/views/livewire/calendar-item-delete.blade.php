@if(!empty($item))
<div>
    <x-jet-dropdown-link wire:click.prevent="$toggle('confirmingItemDeletion')" wire:loading.attr="disabled" class="cursor-pointer" title="Delete">
        <i class="fa fa-trash"></i>
    </x-jet-dropdown-link>
    <x-jet-confirmation-modal wire:model="confirmingItemDeletion">
        <x-slot name="title">
            {{ __('Delete ' . last(explode('\\', $item->model_type))) }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this ' . last(explode('\\', $item->model_type)) . '? Once a ' . last(explode('\\', $item->model_type)) . ' is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingItemDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete ' . last(explode('\\', $item->model_type))) }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
@endif
