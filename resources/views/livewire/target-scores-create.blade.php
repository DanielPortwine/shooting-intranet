<div>
    <div class="flex items-center">
        <x-jet-button wire:click="$toggle('showingTargetScoresCreate')" wire:loading.attr="disabled">
            {{ __('Submit Scores') }}
        </x-jet-button>
    </div>
    <x-jet-dialog-modal wire:model="showingTargetScoresCreate">
        <x-slot name="title">
            Submit Scores
        </x-slot>

        <x-slot name="content">
            @if($target->hasMedia('target_photos'))
                <img src="{{ $target->getFirstMediaUrl('target_photos') }}" class="mb-2">
            @endif
            <p>Enter the quantity of each score attained:</p>
            <form wire:submit.prevent="submit">
                @csrf
                <div class="grid grid-cols-2 mt-2">
                    @foreach($target->type->scores as $score)
                        <div class="flex items-center">
                            <x-jet-label for="score-{{ $score->score }}" value="{{ $score->score }}" class="w-8 text-right mr-2" />
                            <x-jet-input id="score-{{ $score->score }}" wire:model.defer="shots.{{ $score->score }}" class="w-12 block mt-1 appearance-none" type="number" placeholder="0" min="0" />
                        </div>
                        @error('shots.'.$score->score) <span class="text-red-500">{{ $message }}</span> @enderror
                    @endforeach
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showingTargetScoresCreate')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" wire:click="createTargetScores" wire:loading.attr="disabled">
                Submit
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
