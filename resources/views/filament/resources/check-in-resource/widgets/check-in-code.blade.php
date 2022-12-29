<x-filament::widget>
    <x-filament::card>
        <h4 class="text-sm font-medium text-gray-500">Today's QR Code</h4>
        {!! QrCode::size(100)->generate(route('check-in-create', hash('sha256', config('app.check_in_secret') . Carbon\Carbon::now()->format('Y-m-d')))); !!}
        <x-filament::button wire:click="download">Download</x-filament::button>
    </x-filament::card>
</x-filament::widget>
