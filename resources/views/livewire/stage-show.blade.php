<div>
    <x-slot name="header">
        <div class="flex gap-2 items-center">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight flex-grow">
                {{ $stage->title }}
            </h1>
            @if($stage->competition->user_id === Auth()->id())
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-jet-button class="font-bold">···</x-jet-button>
                    </x-slot>
                    <x-slot name="content">
                        @livewire('stage-edit', ['stage' => $stage, 'refresh' => 'stage-show'])
                        @livewire('stage-delete', ['stage' => $stage])
                    </x-slot>
                </x-jet-dropdown>
            @endif
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto my-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
            <p>{!! nl2br(e($stage->description)) !!}</p>
            @if($stage->hasMedia('stage_media'))
                <x-carousel carousel="stage-{{ $stage->id }}-carousel" arrows="true">
                    <x-slot name="indicators">
                        @foreach($stage->getMedia('stage_media') as $media)
                            <x-carousel-indicator carousel="stage-{{ $stage->id }}-carousel" slide="{{ $loop->index + 1  }}"></x-carousel-indicator>
                        @endforeach
                    </x-slot>
                    <x-slot name="items">
                        @php $slide = 1 @endphp
                        @foreach($stage->getMedia('stage_media') as $media)
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
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
            @if(!$stage->completed())
                <h2 class="text-lg font-semibold">Shooters</h2>
                <div class="divide-y divide-gray-300">
                    @foreach($stage->competition->shooters as $shooter)
                        @livewire('stage-shooters-show', ['stage' => $stage, 'shooter' => $shooter])
                    @endforeach
                </div>
            @else
                <h2 class="text-lg font-semibold">Results</h2>
                <div class="divide-y divide-gray-300">
                    <div class="grid grid-cols-6">
                        <h3 class="font-semibold">Shooter</h3>
                        <h3 class="font-semibold">Time</h3>
                        <h3 class="font-semibold">Points</h3>
                        <h3 class="font-semibold">Penalties</h3>
                        <h3 class="font-semibold">Score</h3>
                        <h3 class="font-semibold">Percentage</h3>
                    </div>
                    @foreach($stage->shooters->sortByDesc('pivot.score') as $shooter)
                        <div class="grid grid-cols-6">
                            <p>{{ $shooter->name }}</p>
                            @if($shooter->pivot->score !== null)
                                <p>{{ decimalise($shooter->pivot->time) }}s</p>
                                <p>{{ $shooter->pivot->points }}</p>
                                <p>{{ $shooter->pivot->penalties }}</p>
                                <p>{{ $shooter->pivot->score }}</p>
                                <p>{{ round(($shooter->pivot->score / $stage->shooters->sortByDesc('pivot.score')->first()->pivot->score) * 100, 2) }}%</p>
                            @else
                                @for($x = 0; $x < 6; $x++)
                                    <p>No Score</p>
                                @endfor
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
