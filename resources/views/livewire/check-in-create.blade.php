<div class="max-w-4xl w-full mx-auto px-6 lg:px-8 my-12 py-4 bg-white rounded-xl shadow-xl">
    <div>
        @if (session()->has('success') && $show)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500 cursor-pointer" wire:click="$set('show', false)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
            </div>
        @endif
    </div>
    <form wire:submit.prevent="createCheckIn">
        @csrf
        <input wire:model.defer="token" type="hidden">
        @error('token') <span class="text-red-500">{{ $message }}</span> @enderror
        @if(Auth()->user()->has('firearms'))
            <x-jet-label for="firearms" value="{{ __('Firearm(s)') }}" />
            @foreach($availableFirearms as $availableFirearm)
                <div class="flex gap-2 items-center">
                    <x-jet-checkbox wire:model.defer="firearms" id="firearm{{ $loop->index }}" value="{{ $availableFirearm['id'] }}" />
                    <x-jet-label for="firearm{{ $loop->index }}" value="{{ $availableFirearm['fac_number'] }} - {{ $availableFirearm['make'] }} {{ $availableFirearm['model'] }}" />
                </div>
            @endforeach
            <div class="flex gap-2 items-center">
                <x-jet-checkbox wire:model.defer="firearms" id="firearm_cg" value="1" />
                <x-jet-label for="firearm_cg" value="Club Gun" />
            </div>
            @error('firearms') <span class="text-red-500">{{ $message }}</span> @enderror
        @else
            <div class="mt-4">
                <x-jet-label for="firearm" value="{{ __('Firearm') }}" />
                <x-jet-input id="firearm" wire:model.defer="firearm" class="block mt-1 w-full" type="text" required />
            </div>
            @error('firearm') <span class="text-red-500">{{ $message }}</span> @enderror
        @endif
        <div class="flex items-center justify-end mt-4">
            <x-jet-button class="ml-4">
                {{ __('Check In') }}
            </x-jet-button>
        </div>
    </form>
</div>
