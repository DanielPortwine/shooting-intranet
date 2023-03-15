<x-filament::widget>
    <x-filament::card>
        <h4 class="text-xl font-semibold tracking-tight filament-card-heading">Today's QR Code</h4>
        {!! QrCode::size(100)->generate(route('check-in-create', hash('sha256', config('app.check_in_secret') . Carbon\Carbon::now()->format('Y-m-d')))); !!}
        <x-filament::button wire:click="download">Download</x-filament::button>
        <x-filament::button wire:click="open">Open</x-filament::button>
    </x-filament::card>
</x-filament::widget>
