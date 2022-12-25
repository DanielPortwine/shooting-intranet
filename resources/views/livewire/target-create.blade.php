<div>
    @if($dropdown)
        <x-jet-dropdown-link wire:click.prevent="$toggle('showingTargetCreate')" wire:loading.attr="disabled" class="cursor-pointer">
            {{ __('Add Target') }}
        </x-jet-dropdown-link>
    @else
        <div class="flex items-center">
            <x-jet-action-message class="mr-3" on="created">
                {{ __('Created.') }}
            </x-jet-action-message>
            <x-jet-button wire:click="$toggle('showingTargetCreate')" wire:loading.attr="disabled">
                {{ __('Add Target') }}
            </x-jet-button>
        </div>
    @endif
    <x-jet-dialog-modal wire:model="showingTargetCreate">
        <x-slot name="title">
            Add Target
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="submit">
                @csrf
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea wire:model.defer="description" id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="target_type" value="{{ __('Target Type') }}" />
                    <select wire:model.defer="target_type" id="target_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        @foreach($targetTypes as $type)
                            <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                        @endforeach
                    </select>
                    @error('target_type') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="photo" value="{{ __('Photo') }}" />
                    <x-jet-input wire:model="photo" id="photo" class="block mt-1 w-full" type="file" />
                    @if ($photo)
                        Photo Preview:
                        <img src="{{ $photo->temporaryUrl() }}">
                    @endif
                    @error('photo') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showingTargetCreate')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" wire:click="createTarget" wire:loading.attr="disabled">
                Create
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
