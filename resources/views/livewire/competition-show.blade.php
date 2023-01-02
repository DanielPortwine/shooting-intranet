<div>
    <x-slot name="header">
        <div class="flex gap-2 items-center">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight flex-grow">
                {{ $competition->title }} - {{ $competition->date->format('d M Y H:i') }}
            </h1>
            @if($competition->user_id === Auth()->id())
{{--                @livewire('target-create', ['competitionID' => $competition->id])--}}
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-jet-button class="font-bold">···</x-jet-button>
                    </x-slot>
                    <x-slot name="content">
                        @livewire('competition-edit', ['competition' => $competition, 'refresh' => 'competition-show'])
                        @livewire('competition-delete', ['competition' => $competition, 'dropdown' => true])
                    </x-slot>
                </x-jet-dropdown>
            @endif
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto my-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $competition->user->profile_photo_url }}" alt="{{ $competition->user->name }}" />
                    <span class="ml-2 text-xl">{{ $competition->user->name }}</span>
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
            <p>{!! nl2br(e($competition->description)) !!}</p>
            @if($competition->hasMedia('competition_media'))
                <x-carousel carousel="competition-{{ $competition->id }}-carousel" arrows="true">
                    <x-slot name="indicators">
                        @foreach($competition->getMedia('competition_media') as $media)
                            <x-carousel-indicator carousel="competition-{{ $competition->id }}-carousel" slide="{{ $loop->index + 1  }}"></x-carousel-indicator>
                        @endforeach
                    </x-slot>
                    <x-slot name="items">
                        @php $slide = 1 @endphp
                        @foreach($competition->getMedia('competition_media') as $media)
                            <x-carousel-item slide="{{ $loop->index + 1 }}">
                                <x-slot name="item">
                                    <div class="flex aspect-square sm:aspect-video w-full block bg-gray-800 items-center">
                                        <x-multimedia
                                            src="{{ $media->getUrl() }}"
                                            mime="{{ $media->mime_type }}"
                                            class="h-full w-full object-contain"
                                        >
                                        </x-multimedia>
                                    </div>
                                </x-slot>
                            </x-carousel-item>
                        @endforeach
                    </x-slot>
                </x-carousel>
            @endif
        </div>
{{--        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">--}}
{{--            @foreach($competition->targets as $target)--}}
{{--                @livewire('target-card', ['target' => $target, 'competitionID' => $competition->id], key($target->id))--}}
{{--            @endforeach--}}
{{--        </div>--}}
    </div>
</div>
