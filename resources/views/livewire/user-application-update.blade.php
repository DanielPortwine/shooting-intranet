<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Application') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <x-jet-validation-errors class="mb-4" />
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

        <form wire:submit.prevent="submit">
            @csrf
            <div class="md:flex flex-grow gap-2">
                <div class="mt-4 w-full">
                    <x-jet-label for="surname" value="{{ __('Surname') }}" />
                    <x-jet-input id="surname" wire:model="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname"/>
                </div>
                <div class="mt-4 w-full">
                    <x-jet-label for="forenames" value="{{ __('Forename(s)') }}" />
                    <x-jet-input id="forenames" wire:model="forenames" class="block mt-1 w-full" type="text" name="forenames" :value="old('forenames')" required autocomplete="forenames" />
                </div>
            </div>
            <div class="md:flex flex-grow gap-2">
                <div class="mt-4 w-full">
                    <x-jet-label for="home_phone" value="{{ __('Home Phone Number') }}" />
                    <x-jet-input id="home_phone" wire:model="home_phone" class="block mt-1 w-full" type="text" name="home_phone" :value="old('home_phone')" required autocomplete="home_phone" />
                </div>
                <div class="mt-4 w-full">
                    <x-jet-label for="mobile_phone" value="{{ __('Mobile Number') }}" />
                    <x-jet-input id="mobile_phone" wire:model="mobile_phone" class="block mt-1 w-full" type="text" name="mobile_phone" :value="old('mobile_phone')" required autocomplete="mobile_phone" />
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Current Address') }}" />
                <x-jet-input id="address" wire:model="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="address" />
            </div>
            <div class="mt-4">
                <x-jet-label for="previous_address" value="{{ __('Previous Address (if you have lived somewhere else in the last 5 years)') }}" />
                <x-jet-input id="previous_address" wire:model="previous_address" class="block mt-1 w-full" type="text" name="previous_address" :value="old('previous_address')" required autocomplete="previous_address" />
            </div>
            <div class="md:flex flex-grow gap-2">
                <div class="mt-4 w-full">
                    <x-jet-label for="date_of_birth" value="{{ __('Date of Birth') }}" />
                    <x-jet-input id="date_of_birth" wire:model="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required autocomplete="date_of_birth" />
                </div>
                <div class="mt-4 w-full">
                    <x-jet-label for="nationality" value="{{ __('Nationality') }}" />
                    <x-jet-input id="nationality" wire:model="nationality" class="block mt-1 w-full" type="text" name="nationality" :value="old('nationality')" required autocomplete="nationality" />
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="occupation" value="{{ __('Occupation') }}" />
                <x-jet-input id="occupation" wire:model="occupation" class="block mt-1 w-full" type="text" name="occupation" :value="old('occupation')" required autocomplete="occupation" />
            </div>
            <div class="mt-4">
                <x-jet-label for="convictions" value="{{ __('Criminal Convictions') }}" />
                <x-jet-input id="convictions" wire:model="convictions" class="block mt-1 w-full" type="text" name="convictions" :value="old('convictions')" required autocomplete="convictions" />
            </div>
            <div class="mt-4">
                <x-jet-label for="clubs" value="{{ __('Clubs/Associations') }}" />
                <x-jet-input id="clubs" wire:model="clubs" class="block mt-1 w-full" type="text" name="clubs" :value="old('clubs')" required autocomplete="clubs" />
            </div>
            <div class="mt-4">
                <x-jet-label for="primary_club" value="{{ __('Primary Club') }}" />
                <x-jet-input id="primary_club" wire:model="primary_club" class="block mt-1 w-full" type="text" name="primary_club" :value="old('primary_club')" required autocomplete="primary_club" />
            </div>
            <div class="mt-4">
                <x-jet-label for="membership_refused" value="{{ __('Have you ever been refused club/association membership? Please provide details.') }}" />
                <x-jet-input id="membership_refused" wire:model="membership_refused" class="block mt-1 w-full" type="text" name="membership_refused" :value="old('membership_refused')" required autocomplete="membership_refused" />
            </div>
            <div class="mt-4">
                <x-jet-label for="qualifications" value="{{ __('List any firearms training/qualifications you have completed.') }}" />
                <x-jet-input id="qualifications" wire:model="qualifications" class="block mt-1 w-full" type="text" name="qualifications" :value="old('qualifications')" required autocomplete="qualifications" />
            </div>
            <div class="mt-4">
                <x-jet-label for="experience" value="{{ __('List any previous firearms experience you have.') }}" />
                <x-jet-input id="experience" wire:model="experience" class="block mt-1 w-full" type="text" name="experience" :value="old('experience')" required autocomplete="experience" />
            </div>
            <div class="md:flex flex-grow gap-2">
                <div class="mt-4 w-full">
                    <x-jet-label for="fac_number" value="{{ __('FAC Number') }}" />
                    <x-jet-input id="fac_number" wire:model="fac_number" class="block mt-1 w-full" type="text" name="fac_number" :value="old('fac_number')" required autocomplete="fac_number" />
                </div>
                <div class="mt-4 w-full">
                    <x-jet-label for="fac_force" value="{{ __('FAC Issuing Force') }}" />
                    <x-jet-input id="fac_force" wire:model="fac_force" class="block mt-1 w-full" type="text" name="fac_force" :value="old('fac_force')" required autocomplete="fac_force" />
                </div>
                <div class="mt-4 w-full">
                    <x-jet-label for="fac_expiry" value="{{ __('FAC Expiry') }}" />
                    <x-jet-input id="fac_expiry" wire:model="fac_expiry" class="block mt-1 w-full" type="date" name="fac_expiry" :value="old('fac_expiry')" autocomplete="fac_expiry" />
                </div>
            </div>
            <div class="md:flex flex-grow gap-2">
                <div class="mt-4 w-full">
                    <x-jet-label for="sgc_number" value="{{ __('SGC Number') }}" />
                    <x-jet-input id="sgc_number" wire:model="sgc_number" class="block mt-1 w-full" type="text" name="sgc_number" :value="old('sgc_number')" required autocomplete="sgc_number" />
                </div>
                <div class="mt-4 w-full">
                    <x-jet-label for="sgc_force" value="{{ __('SGC Issuing Force') }}" />
                    <x-jet-input id="sgc_force" wire:model="sgc_force" class="block mt-1 w-full" type="text" name="sgc_force" :value="old('sgc_force')" required autocomplete="sgc_force" />
                </div>
                <div class="mt-4 w-full">
                    <x-jet-label for="sgc_expiry" value="{{ __('SGC Expiry') }}" />
                    <x-jet-input id="sgc_expiry" wire:model="sgc_expiry" class="block mt-1 w-full" type="date" name="sgc_expiry" :value="old('sgc_expiry')" autocomplete="sgc_expiry" />
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="certificate_refused" value="{{ __('Have you ever been refused a FAC or SGC? Please provide details.') }}" />
                <x-jet-input id="certificate_refused" wire:model="certificate_refused" class="block mt-1 w-full" type="text" name="certificate_refused" :value="old('certificate_refused')" required autocomplete="certificate_refused" />
            </div>
            <div class="mt-4">
                <x-jet-label for="certificate_prevented" value="{{ __('Do you know of any reasons why you would not be granted a FAC/SGC? Please provide details.') }}" />
                <x-jet-input id="certificate_prevented" wire:model="certificate_prevented" class="block mt-1 w-full" type="text" name="certificate_prevented" :value="old('certificate_prevented')" required autocomplete="certificate_prevented" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Update') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
