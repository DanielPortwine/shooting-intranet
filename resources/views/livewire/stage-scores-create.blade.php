<div>
    <div wire:click="$toggle('showingStageScoresCreate')" class="flex cursor-pointer p-2">
        <p>{{ $shooter->name }}</p>
    </div>
    <x-jet-dialog-modal wire:model="showingStageScoresCreate">
        <x-slot name="title">
            Submit Scores for {{ $shooter->name }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="submit">
                @csrf
                <div class="mt-4">
                    <x-jet-label for="time" value="{{ __('Time') }}" />
                    <x-jet-input wire:model.debounce.250ms="time" id="time" type="number" class="w-24 block mt-1 appearance-none" required />
                    @error('time') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="target_quantity" value="{{ __('Enter the quantity of each score attained:') }}" />
                    @foreach($stage->targets as $target)
                        @php $firstRow = $loop->first @endphp
                        <div class="flex gap-2 items-center mt-2">
                            @foreach($target->type->scores as $score)
                                <div class="">
                                    @if($firstRow) <x-jet-label for="score-{{ $score->score }}" value="{{ $score->score }}" class="w-8 text-right mr-2" /> @endif
                                    <x-jet-input id="score-{{ $score->score }}" wire:model.defer="targets.{{ $target->id }}.{{ $score->score }}" class="w-12 block mt-1" type="text" placeholder="{{ $score->score }}" />
                                </div>
                                @error('shots.'.$score->score) <span class="text-red-500">{{ $message }}</span> @enderror
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <x-jet-label for="penalties" value="{{ __('Penalties') }}" />
                    <x-jet-input wire:model.defer="penalties" id="penalties" type="number" class="w-24 block mt-1 appearance-none" />
                    @error('penalties') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="no_score" value="{{ __('No Score') }}" />
                    <x-jet-checkbox wire:model.defer="no_score" id="no_score" />
                    @error('no_score') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showingStageScoresCreate')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" wire:click="createTargetScores" wire:loading.attr="disabled">
                Submit
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
