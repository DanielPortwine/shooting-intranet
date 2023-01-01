<div>
    <x-jet-dropdown-link wire:click.prevent="$toggle('showingFirearmEdit')" wire:loading.attr="disabled" class="cursor-pointer">
        {{ __('Edit') }}
    </x-jet-dropdown-link>
    <x-jet-dialog-modal wire:model="showingFirearmEdit">
        <x-slot name="title">
            Edit Firearm
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="submit">
                @csrf
                <div class="mt-4">
                    <x-jet-label for="make" value="{{ __('Make') }}" />
                    <x-jet-input wire:model.defer="firearm.make" id="make" type="text" class="block mt-1 w-full" />
                </div>
                @error('make') <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="mt-4">
                    <x-jet-label for="model" value="{{ __('Model') }}" />
                    <x-jet-input wire:model.defer="firearm.model" id="model" type="text" class="block mt-1 w-full" />
                </div>
                @error('model') <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="mt-4">
                    <x-jet-label for="fac_number" value="{{ __('Number (on FAC)') }}" />
                    <x-jet-input wire:model.defer="firearm.fac_number" id="fac_number" type="number" class="block mt-1 w-full" />
                </div>
                @error('fac_number') <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="mt-4">
                    <x-jet-label for="serial" value="{{ __('Serial Number') }}" />
                    <x-jet-input wire:model.defer="firearm.serial" id="serial" type="text" class="block mt-1 w-full" />
                </div>
                @error('serial') <span class="text-red-500">{{ $message }}</span> @enderror
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showingFirearmEdit')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                Update
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
