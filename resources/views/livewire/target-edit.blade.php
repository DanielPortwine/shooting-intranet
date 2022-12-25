<div>
    <x-jet-dropdown-link wire:click.prevent="$toggle('showingTargetEdit')" wire:loading.attr="disabled" class="cursor-pointer">
        {{ __('Edit') }}
    </x-jet-dropdown-link>
    <x-jet-dialog-modal wire:model="showingTargetEdit">
        <x-slot name="title">
            Edit Target
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="submit">
                @csrf
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea wire:model.defer="target.description" id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    @error('target.description') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="target_type" value="{{ __('Target Type') }}" />
                    <select wire:model.defer="target.type_id" id="target_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        @foreach($targetTypes as $type)
                            <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                        @endforeach
                    </select>
                    @error('target.target_type') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="photo" value="{{ __('Photo (click to remove)') }}" />
                    <img wire:click="$toggle('deletePhoto')" src="{{ $target->getFirstMediaUrl('target_photos') }}" class="@if($deletePhoto)opacity-40 @endif">
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
            <x-jet-secondary-button wire:click="$toggle('showingTargetEdit')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                Update
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

