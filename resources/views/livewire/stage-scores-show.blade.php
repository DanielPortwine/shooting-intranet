<div>
    <div wire:click="$toggle('showingStageScoresShow')" class="flex cursor-pointer p-2">
        <p class="flex-grow">{{ $shooter->name }}</p>
        <p>{{ $score ?? 'No Score' }}</p>
    </div>
    <x-jet-dialog-modal wire:model="showingStageScoresShow">
            <x-slot name="title">
                Scores for {{ $shooter->name }}
            </x-slot>
            <x-slot name="content">
                @if(isset($score))
                    <p class="text-lg font-semibold">Time: {{ $time }}s</p>
                    <p>Shots:</p>
                    @foreach($stage->targets as $target)
                        <div class="">
                            @foreach($target->scores->where('user_id', $shooter->id) as $targetScore)
                                <span>{{ $targetScore->score->score }}</span>
                            @endforeach
                        </div>
                    @endforeach
                    <p>Penalties: {{ $stage->shooters->where('id', $shooter->id)->first()->pivot->penalties }}</p>
                    <p>Score: {{ $score }}</p>
                @else
                    <p class="text-lg semibold">No Score</p>
                @endif
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showingStageScoresShow')" wire:loading.attr="disabled">
                    Close
                </x-jet-secondary-button>
            </x-slot>
    </x-jet-dialog-modal>
</div>
