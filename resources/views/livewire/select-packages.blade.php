<div>
    @if(count($packages))
        <h3 class="text-lg font-semibold mt-4">Add a new package:</h3>
        <p>Select the packages you wish to apply for:</p>
        <form wire:submit.prevent="selectPackages">
            @csrf
            @foreach($packages as $package)
                <x-jet-label for="package-{{ $package->id }}">
                    <div class="flex items-center">
                        <x-jet-checkbox wire:model.defer="selectedPackages" id="package-{{ $package->id }}" value="{{ $package->id }}" />
                        <div class="ml-2">
                            {{ $package->name }} - £{{ $package->price }}
                        </div>
                    </div>
                </x-jet-label>
            @endforeach
            <x-jet-button type="submit" class="mt-4">Apply</x-jet-button>
        </form>
    @endif
</div>
