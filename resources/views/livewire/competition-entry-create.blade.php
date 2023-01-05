<div>
    <div class="flex items-center">
        @if(empty($competition->hasShooter(Auth()->user())))
            <x-jet-button wire:click="enter" wire:loading.attr="disabled">
                {{ __('Enter') }}
            </x-jet-button>
        @else
            <x-jet-danger-button wire:click="cancel" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
        @endif
    </div>
</div>
