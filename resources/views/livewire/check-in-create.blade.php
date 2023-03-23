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
        <x-jet-label for="firearms" value="{{ __('Firearm(s)') }}" />
        @foreach($availableFirearms as $availableFirearm)
            <div class="flex gap-2 items-center">
                <x-jet-checkbox wire:model.defer="firearms" id="firearm{{ $loop->index }}" value="{{ $availableFirearm->id }}" />
                @if($availableFirearm->fac_number !== 0)
                    <x-jet-label for="firearm{{ $loop->index }}">{{ $availableFirearm->fac_number }} - {{ $availableFirearm->make }} {{ $availableFirearm->model }}</x-jet-label>
                @else
                    <x-jet-label for="firearm{{ $loop->index }}">Club Gun</x-jet-label>
                @endif
            </div>
        @endforeach
        @error('firearms') <span class="text-red-500">{{ $message }}</span> @enderror
        @if($showingGuestCreate)
            <input type="hidden" name="guest" value="true">
            <h3 class="mt-4">Guest details</h3>
            <div class="md:flex flex-grow gap-2">
                <div class="mt-4 w-full">
                    <x-jet-label for="surname" value="{{ __('Surname') }}" />
                    <x-jet-input id="surname" wire:model.defer="surname" class="block mt-1 w-full" type="text" required autofocus autocomplete="surname" />
                    @error('surname') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4 w-full">
                    <x-jet-label for="forenames" value="{{ __('Forename(s)') }}" />
                    <x-jet-input id="forenames" wire:model.defer="forenames" class="block mt-1 w-full" type="text" required autocomplete="forenames" />
                    @error('forenames') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" wire:model.defer="email" class="block mt-1 w-full" type="email" required autocomplete="email" />
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="md:flex flex-grow gap-2">
                <div class="mt-4 w-full">
                    <x-jet-label for="home_phone" value="{{ __('Home Phone Number') }}" />
                    <x-jet-input id="home_phone" wire:model.defer="home_phone" class="block mt-1 w-full" type="text" required autocomplete="home_phone" />
                    @error('home_phone') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4 w-full">
                    <x-jet-label for="mobile_phone" value="{{ __('Mobile Number') }}" />
                    <x-jet-input id="mobile_phone" wire:model.defer="mobile_phone" class="block mt-1 w-full" type="text" required autocomplete="mobile_phone" />
                    @error('mobile_phone') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Username') }}" />
                <x-jet-input id="name" wire:model.defer="name" class="block mt-1 w-full" type="text" required autocomplete="name" />
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" wire:model.defer="password" class="block mt-1 w-full" type="password" required autocomplete="new-password" />
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" wire:model.defer="password_confirmation" class="block mt-1 w-full" type="password" required autocomplete="new-password" />
                @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif
        @endif
        <div class="flex items-center justify-end mt-4">
            @if($guestDay)
                <x-jet-button wire:click.prevent="$toggle('showingGuestCreate')" class="ml-4">
                    {{ $showingGuestCreate ? __('Remove Guest') : __('Add Guest') }}
                </x-jet-button>
            @endif
            <x-jet-button class="ml-4">
                {{ __('Check In') }}
            </x-jet-button>
        </div>
    </form>
</div>
