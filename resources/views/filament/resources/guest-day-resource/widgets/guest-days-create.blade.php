<x-filament::widget>
    <x-filament::card>
        <x-filament::card.heading>
            {{ $action }} recurring guest days
        </x-filament::card.heading>

        <x-filament::hr />

        <form wire:submit.prevent="{{ strtolower($action) }}" class="">
            {{ $this->form }}

            <button type="submit" class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action mt-4">
                {{ $action }}
            </button>

            @if(!empty($recurringGuestDay))
                <button wire:click.prevent="clear" class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action mt-4">
                    Clear
                </button>
            @endif
        </form>
    </x-filament::card>
</x-filament::widget>
