<div class="max-w-7xl mx-auto my-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        <div class="flex gap-2 items-center">
            <p>{{ $firearm->fac_number }}: {{ $firearm->make }} {{ $firearm->model }}</p>
            <div class="flex-grow"></div>
            <x-jet-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="text-xl font-bold">···</button>
                </x-slot>
                <x-slot name="content">
                    @livewire('firearm-edit', ['firearm' => $firearm])
                    @livewire('firearm-delete', ['firearm' => $firearm])
                </x-slot>
            </x-jet-dropdown>
        </div>
        @if(!empty($firearm->serial))
            <p class="text-sm">Serial Number: {{ $firearm->serial }}</p>
        @endif
        <p class="text-sm">Last used: {{ count($firearm->checkIns) ? $firearm->checkIns()->orderByDesc('date')->first()->date->diffForHumans() : 'Never' }}</p>
    </div>
</div>
