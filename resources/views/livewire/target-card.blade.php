<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <div class="flex w-full">
        <p class="flex-grow break-words w-full">{!! nl2br(e($target->description)) !!}</p>
        @if($target->user_id === Auth()->id())
            <x-jet-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="text-xl font-bold">···</button>
                </x-slot>
                <x-slot name="content">
                    @livewire('target-edit', ['target' => $target])
                    @livewire('target-delete', ['target' => $target])
                </x-slot>
            </x-jet-dropdown>
        @endif
    </div>
    @if($target->hasMedia('target_photos'))
        <img src="{{ $target->getFirstMediaUrl('target_photos') }}" class="mb-2">
    @endif
    @if(!empty($target->scores->first()))
        <div>
            <ul>
                @foreach($target->type->scores as $score)
                    <li>{{ $target->scores->where('score_id', $score->id)->count() }} x {{ $score->score }}</li>
                @endforeach
            </ul>
            @if($target->type->name === 'Numeric')
                Total: {{ $target->scores->sum('score.score') }}
            @endif
        </div>
    @endif
    <div class="flex flex-wrap gap-2">
        @if(empty($target->scores->first()) && $target->user_id === Auth()->id())
            @livewire('target-scores-create', ['target' => $target])
        @endif
        @if(!$target->hasMedia('target_photos'))
            <x-jet-button>Add Photo</x-jet-button>
        @endif
    </div>
</div>
