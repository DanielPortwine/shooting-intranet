<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-grow">
                {{ __('Range Visits') }}
            </h2>
            @livewire('visit-create')
        </div>
    </x-slot>

    <div class="py-12">
        @foreach($visits as $visit)
            @livewire('visit-card', ['visit' => $visit], key($visit->id))
        @endforeach
    </div>
</div>
