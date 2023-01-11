<div>
    <x-jet-dropdown-link wire:click.prevent="$toggle('showingItemEdit')" wire:loading.attr="disabled" class="cursor-pointer" title="Edit">
        <i class="fa fa-pencil"></i>
    </x-jet-dropdown-link>
    <x-jet-dialog-modal wire:model="showingItemEdit">
        <x-slot name="title">
            <p class="grow">Edit {{ $model->title }}</p>
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="submit">
                @csrf
                <div class="mt-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input wire:model.defer="model.title" id="title" type="text" class="block mt-1 w-full" required />
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea wire:model.defer="model.description" id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="date" value="{{ __('Date') }}" />
                    <x-jet-input wire:model.defer="date" id="date" class="block mt-1 w-full" type="datetime-local" required />
                    @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="private" value="{{ __('Private') }}" />
                    <x-jet-checkbox wire:model.defer="model.private" id="private" />
                    @error('private') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showingItemEdit')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                Update
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
