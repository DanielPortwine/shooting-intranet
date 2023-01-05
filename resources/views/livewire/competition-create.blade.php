<div>
    <div class="flex items-center">
        <x-jet-action-message class="mr-3" on="created">
            {{ __('Created.') }}
        </x-jet-action-message>
        <x-jet-button wire:click="$toggle('showingCompetitionCreate')" wire:loading.attr="disabled">
            {{ __('Create') }}
        </x-jet-button>
    </div>
    <x-jet-dialog-modal wire:model="showingCompetitionCreate">
        <x-slot name="title">
            Create Competition
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="submit">
                @csrf
                <div class="mt-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input wire:model.defer="title" id="title" type="text" class="block mt-1 w-full" required />
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea wire:model.defer="description" id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="date" value="{{ __('Date') }}" />
                    <x-jet-input wire:model.defer="date" id="date" class="block mt-1 w-full" type="datetime-local" required />
                    @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
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
                    <x-jet-label for="private" value="{{ __('Private') }}" />
                    <x-jet-checkbox wire:model.defer="private" id="private" />
                    @error('private') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="media" value="{{ __('Media') }}" />
                    <x-jet-input wire:model="media" id="media" class="block mt-1 w-full" type="file" multiple />
                    <p wire:loading wire:target="media">Uploading...</p>
                    @if ($media)
                        Media Preview:
                        @foreach($media as $mediaItem)
                            <x-multimedia
                                src="{!! $mediaItem->temporaryUrl() !!}"
                                mime="{{ $mediaItem->getMimeType() }}"
                            >
                            </x-multimedia>
                        @endforeach
                    @endif
                    @error('media') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showingCompetitionCreate')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" wire:click="createCompetition" wire:loading.attr="disabled">
                Create
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
