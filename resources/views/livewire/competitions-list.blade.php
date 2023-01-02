<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-grow">
                {{ __('Competitions') }}
            </h2>
            @livewire('competition-create')
        </div>
    </x-slot>

    <div class="py-12">
        @foreach($competitions as $competition)
            @livewire('competition-card', ['competition' => $competition], key($competition->id))
        @endforeach
    </div>
</div>
