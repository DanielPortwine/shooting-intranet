<div class="max-w-7xl mx-auto my-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        <div class="flex gap-2 items-center">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $competition->user->profile_photo_url }}" alt="{{ $competition->user->name }}" />
                    <div class="text-left">
                        <span class="ml-2 font-semibold">{{ $competition->user->name }}</span>
                        <div class="flex gap-1">
                            <p class="ml-2 text-xs" title="{{ $competition->created_at->format('d M Y H:i') }}">{{ $competition->created_at->diffForHumans() }}</p>
                            @if($competition->private)
                                <i class="fa fa-lock text-gray-800 text-xs" title="Private"></i>
                            @endif
                        </div>
                    </div>
                </button>
            @else
                <span class="inline-flex rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                        {{ $competition->user->name }}
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
            @endif
            @if($competition->user_id === Auth()->id())
                <div class="flex-grow"></div>
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="text-xl font-bold">···</button>
                    </x-slot>
                    <x-slot name="content">
                        @livewire('competition-edit', ['competition' => $competition, 'refresh' => 'competition-card'])
                        @livewire('competition-delete', ['competition' => $competition, 'refresh' => true])
                    </x-slot>
                </x-jet-dropdown>
            @endif
        </div>
        <div  wire:click="show" class="cursor-pointer">
            <h4 class="text-xl font-semibold hover:underline cursor-pointer">{{ $competition->title }}
                @if($competition->completed())
                    [Completed]
                @endif
            </h4>
            <p class="text-sm">{{ $competition->date->format('d M Y H:i') }}</p>
            <a class="underline text-sm text-gray-600 hover:text-gray-900 cursor-pointer">
                {{ $competition->stages->count() }} stages
            </a>
            <p>{!! nl2br(e($competition->description)) !!}</p>
            @if($competition->hasMedia('competition_media'))
                @switch($competition->getMedia('competition_media')->count())
                    @case(1)
                        <div class="aspect-video relative">
                            <x-multimedia
                                src="{{ $competition->getFirstMedia('competition_media')->getUrl() }}"
                                mime="{{ $competition->getFirstMedia('competition_media')->mime_type }}"
                                class="h-full w-full object-cover absolute"
                            >
                            </x-multimedia>
                            <button wire:click="show" class="w-full h-full text-white font-semibold md:text-4xl relative items-center bg-opacity-0 hover:bg-opacity-20 active:bg-opacity-30 bg-gray-800 transition cursor-pointer"></button>
                        </div>
                        @break
                    @case(2)
                        <div class="flex">
                            @foreach($competition->getMedia('competition_media')->chunk(2)->first() as $media)
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
                            @foreach($competition->getMedia('competition_media')->chunk(3)->first() as $media)
                                <div class="@if($loop->first) row-span-2 col-span-2 @endif aspect-square relative">
                                    <x-multimedia
                                        src="{{ $media->getUrl() }}"
                                        mime="{{ $media->mime_type }}"
                                        class="h-full w-full object-cover absolute"
                                    >
                                    </x-multimedia>
                                    <button wire:click="show" class="w-full h-full text-white font-semibold md:text-4xl relative items-center @if($loop->last && $competition->getMedia('competition_media')->count() > 3) bg-opacity-60 hover:bg-opacity-70 active:bg-opacity-80 @else bg-opacity-0 hover:bg-opacity-20 active:bg-opacity-30 @endif bg-gray-800 transition cursor-pointer">
                                        @if($loop->last && $competition->getMedia('competition_media')->count() > 3)
                                            <span class="w-full">+{{ $competition->getMedia('competition_media')->count() - 3 }}</span>
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

