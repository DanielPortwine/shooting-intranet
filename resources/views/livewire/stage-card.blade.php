<div class="max-w-7xl mx-auto my-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        <div class="flex gap-2 items-center">
            <h1 wire:click="show" class="flex-grow text-lg font-semibold hover:underline cursor-pointer">{{ $stage->title }}</h1>
            <x-jet-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="text-xl font-bold">···</button>
                </x-slot>
                <x-slot name="content">
                    @livewire('stage-edit', ['stage' => $stage])
                    @livewire('stage-delete', ['stage' => $stage, 'refresh' => true])
                </x-slot>
            </x-jet-dropdown>
        </div>
        <div wire:click="show" class="cursor-pointer">
            @if(count($stage->shooters) > 0)
                <p class="font-semibold">Winner: {{ $stage->shooters->sortByDesc('pivot.score')->first()->name }} with {{ decimalise($stage->shooters->sortByDesc('pivot.score')->first()->pivot->time) }}s</p>
            @endif
            <p class="">{!! nl2br(e($stage->description)) !!}</p>
            <p class="">{{ $stage->targets->count() }} targets</p>
            @if($stage->hasMedia('stage_media'))
                @switch($stage->getMedia('stage_media')->count())
                    @case(1)
                        <div class="aspect-video relative">
                            <x-multimedia
                                src="{{ $stage->getFirstMedia('stage_media')->getUrl() }}"
                                mime="{{ $stage->getFirstMedia('stage_media')->mime_type }}"
                                class="h-full w-full object-cover absolute"
                            >
                            </x-multimedia>
                            <button wire:click="show" class="w-full h-full text-white font-semibold md:text-4xl relative items-center bg-opacity-0 hover:bg-opacity-20 active:bg-opacity-30 bg-gray-800 transition cursor-pointer"></button>
                        </div>
                        @break
                    @case(2)
                        <div class="flex">
                            @foreach($stage->getMedia('stage_media')->chunk(2)->first() as $media)
                                <div class="aspect-square w-full relative">
                                    <x-multimedia
                                        src="{{ $media->getUrl() }}"
                                        mime="{{ $media->mime_type }}"
                                        class="h-full w-full object-cover absolute"
                                    >
                                    </x-multimedia>
                                    <button wire:click="show" class="w-full h-full text-white font-semibold md:text-4xl relative items-center bg-opacity-0 hover:bg-opacity-20 active:bg-opacity-30 bg-gray-800 transition cursor-pointer"></button>
                                </div>
                            @endforeach
                        </div>
                        @break
                    @default
                        <div class="grid grid-rows-2 grid-cols-3">
                            @foreach($stage->getMedia('stage_media')->chunk(3)->first() as $media)
                                <div class="@if($loop->first) row-span-2 col-span-2 @endif aspect-square relative">
                                    <x-multimedia
                                        src="{{ $media->getUrl() }}"
                                        mime="{{ $media->mime_type }}"
                                        class="h-full w-full object-cover absolute"
                                    >
                                    </x-multimedia>
                                    <button wire:click="show" class="w-full h-full text-white font-semibold md:text-4xl relative items-center @if($loop->last && $stage->getMedia('stage_media')->count() > 3) bg-opacity-60 hover:bg-opacity-70 active:bg-opacity-80 @else bg-opacity-0 hover:bg-opacity-20 active:bg-opacity-30 @endif bg-gray-800 transition cursor-pointer">
                                        @if($loop->last && $stage->getMedia('stage_media')->count() > 3)
                                            <span class="w-full">+{{ $stage->getMedia('stage_media')->count() - 3 }}</span>
                                        @endif
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        @break
                @endswitch
            @endif
        </div>
    </div>
</div>
