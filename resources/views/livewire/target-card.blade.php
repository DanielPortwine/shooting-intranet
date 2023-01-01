<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <div class="flex items-center w-full">
        <div class="">
            @if(!empty($target->firearm))
                <p class="text-lg font-semibold">{{ $target->firearm->make }} {{ $target->firearm->model }}</p>
            @elseif(!empty($target->firearm_name))
                <p class="text-lg font-semibold">{{ $target->firearm_name }}</p>
            @endif
            @if(!empty($target->ammunition))
                <p class="">{{ $target->ammunition }}</p>
            @endif
        </div>
        <div class="flex-grow"></div>
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
    <p class="break-words w-full">{!! nl2br(e($target->description)) !!}</p>
    @if($target->hasMedia('target_photos'))
        <img src="{{ $target->getFirstMediaUrl('target_photos') }}" class="mb-2">
    @endif
    @if(!empty($target->scores->first()))
        <div>
            <p class="font-semibold">Scores</p>
            <ul>
                @foreach($target->type->scores as $score)
                    <li>{{ $target->scores->where('score_id', $score->id)->count() }} x {{ $score->score }}</li>
                @endforeach
            </ul>
            Total: <span class="font-semibold">{{ $target->scores->sum('score.value') }}</span>
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
