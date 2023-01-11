<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        <p class="w-11/12 rounded-sm cursor-pointer text-truncate text-white border-l-4 pl-1 mb-1 border-{{ $item->colour }}-700 bg-{{ $item->colour }}-500 hover:bg-{{ $item->colour }}-600 transition">{{ $item->model->date->format('H:i') }} <span class="font-bold">{{ $item->model->title }}</span></p>
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="fixed sm:absolute z-50 @if($above) bottom-0 mb-8 @else mt-1 @endif max-sm:w-full w-48 h-screen sm:h-auto rounded-md shadow-lg top-0 sm:top-auto {{ $dropdownAlign }}-0"
         style="display: none;">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 px-4 sm:px-0 py-8 sm:py-1 h-full bg-white">
            <div class="px-2">
                <div class="flex">
                    <h4 class="text-lg font-semibold text-wrap break-words grow">{{ $item->model->title }}</h4>
                    <x-jet-dropdown-link @click="open = ! open" class="inline-block sm:hidden cursor-pointer" title="Close">
                        <i class="fa fa-times"></i>
                    </x-jet-dropdown-link>
                </div>
                <p class="text-sm">{{ $item->model->date->format('D j M Y, H:i') }}</p>
                <div class="flex">
                    @if(!empty($item->route))
                        <x-jet-dropdown-link href="{{ route($item->route, $item->model_id) }}" class="cursor-pointer" title="View">
                            <i class="fa fa-eye"></i>
                        </x-jet-dropdown-link>
                    @endif
                    @if($item->model->user_id === Auth::id())
                        @livewire('calendar-item-edit', ['item' => $item], key('edit' . $item->id))
                        @livewire('calendar-item-delete', ['item' => $item], key('delete' . $item->id))
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
