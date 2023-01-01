<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-grow">
                {{ __('Firearms') }}
            </h2>
            @livewire('firearm-create')
        </div>
    </x-slot>

    <div class="py-12">
        @foreach($firearms as $firearm)
            @livewire('firearm-card', ['firearm' => $firearm], key($firearm->id))
        @endforeach
    </div>
</div>
