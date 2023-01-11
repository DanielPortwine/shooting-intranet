<div>
    <x-jet-dropdown-link wire:click.prevent="$toggle('showingVisitEdit')" wire:loading.attr="disabled" class="cursor-pointer">
        {{ __('Edit') }}
    </x-jet-dropdown-link>
    <x-jet-dialog-modal wire:model="showingVisitEdit">
        <x-slot name="title">
            Edit Visit
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="submit">
                @csrf
                <div class="mt-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input wire:model.defer="visit.title" id="title" type="text" class="block mt-1 w-full" />
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea wire:model.defer="visit.description" id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="private" value="{{ __('Private') }}" />
                    <x-jet-checkbox wire:model.defer="visit.private" id="private" />
                    @error('private') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="media" value="{{ __('Media (click to remove)') }}" />
                    @foreach($visit->getMedia('visit_media') as $mediaItem)
                        <x-multimedia
                            wire:click="toggleDeleteMedia({{ $mediaItem->id }})"
                            src="{{ $mediaItem->getUrl() }}"
                            mime="{{ $mediaItem->mime_type }}"
                            class="{{ in_array($mediaItem->id, array_keys($mediaToDelete)) ? 'opacity-40' : '' }}"
                        >
                        </x-multimedia>
                    @endforeach
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
                    @error('media.*') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showingVisitEdit')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                Update
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
