<div>
    @if(empty($shooter->stages->where('id', $stage->id)->first()))
        @livewire('stage-scores-create', ['stage' => $stage, 'shooter' => $shooter])
    @else
        @livewire('stage-scores-show', ['stage' => $stage, 'shooter' => $shooter])
    @endif
</div>
