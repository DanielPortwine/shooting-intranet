<x-guest-layout>
    @push('recaptcha')
        <script type="text/javascript">
            function callbackThen(response) {
                response.json().then(function(data) {
                    if (data.success) {
                        document.getElementById('register-button').disabled = false;
                    }
                });
            }
        </script>
        {!! htmlScriptTagJsApi([
            'action' => 'register',
            'callback_then' => 'callbackThen',
        ]) !!}
    @endpush
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <x-jet-authentication-card-logo />
        </div>

        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <p>If any of these fields don't apply, please enter N/A. Do not leave blank.</p>
                </div>
                <div class="md:flex flex-grow gap-2">
                    <div class="mt-4 w-full">
                        <x-jet-label for="surname" value="{{ __('Surname') }}" />
                        <x-jet-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-jet-label for="forenames" value="{{ __('Forename(s)') }}" />
                        <x-jet-input id="forenames" class="block mt-1 w-full" type="text" name="forenames" :value="old('forenames')" required autocomplete="forenames" />
                    </div>
                </div>
                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                </div>
                <div class="md:flex flex-grow gap-2">
                    <div class="mt-4 w-full">
                        <x-jet-label for="home_phone" value="{{ __('Home Phone Number') }}" />
                        <x-jet-input id="home_phone" class="block mt-1 w-full" type="text" name="home_phone" :value="old('home_phone')" required autocomplete="home_phone" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-jet-label for="mobile_phone" value="{{ __('Mobile Number') }}" />
                        <x-jet-input id="mobile_phone" class="block mt-1 w-full" type="text" name="mobile_phone" :value="old('mobile_phone')" required autocomplete="mobile_phone" />
                    </div>
                </div>
                <div class="mt-4">
                    <x-jet-label for="address" value="{{ __('Current Address') }}" />
                    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="address" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="previous_address" value="{{ __('Previous Address (if you have lived somewhere else in the last 5 years)') }}" />
                    <x-jet-input id="previous_address" class="block mt-1 w-full" type="text" name="previous_address" :value="old('previous_address')" required autocomplete="previous_address" />
                </div>
                <div class="md:flex flex-grow gap-2">
                    <div class="mt-4 w-full">
                        <x-jet-label for="date_of_birth" value="{{ __('Date of Birth') }}" />
                        <x-jet-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required autocomplete="date_of_birth" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-jet-label for="nationality" value="{{ __('Nationality') }}" />
                        <x-jet-input id="nationality" class="block mt-1 w-full" type="text" name="nationality" :value="old('nationality')" required autocomplete="nationality" />
                    </div>
                </div>
                <div class="mt-4">
                    <x-jet-label for="occupation" value="{{ __('Occupation') }}" />
                    <x-jet-input id="occupation" class="block mt-1 w-full" type="text" name="occupation" :value="old('occupation')" required autocomplete="occupation" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="convictions" value="{{ __('Criminal Convictions') }}" />
                    <x-jet-input id="convictions" class="block mt-1 w-full" type="text" name="convictions" :value="old('convictions')" required autocomplete="convictions" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="clubs" value="{{ __('Clubs/Associations') }}" />
                    <x-jet-input id="clubs" class="block mt-1 w-full" type="text" name="clubs" :value="old('clubs')" required autocomplete="clubs" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="primary_club" value="{{ __('Primary Club') }}" />
                    <x-jet-input id="primary_club" class="block mt-1 w-full" type="text" name="primary_club" :value="old('primary_club')" required autocomplete="primary_club" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="membership_refused" value="{{ __('Have you ever been refused club/association membership? Please provide details.') }}" />
                    <x-jet-input id="membership_refused" class="block mt-1 w-full" type="text" name="membership_refused" :value="old('membership_refused')" required autocomplete="membership_refused" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="qualifications" value="{{ __('List any firearms training/qualifications you have completed.') }}" />
                    <x-jet-input id="qualifications" class="block mt-1 w-full" type="text" name="qualifications" :value="old('qualifications')" required autocomplete="qualifications" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="experience" value="{{ __('List any previous firearms experience you have.') }}" />
                    <x-jet-input id="experience" class="block mt-1 w-full" type="text" name="experience" :value="old('experience')" required autocomplete="experience" />
                </div>
                <div class="md:flex flex-grow gap-2">
                    <div class="mt-4 w-full">
                        <x-jet-label for="fac_number" value="{{ __('FAC Number') }}" />
                        <x-jet-input id="fac_number" class="block mt-1 w-full" type="text" name="fac_number" :value="old('fac_number')" required autocomplete="fac_number" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-jet-label for="fac_force" value="{{ __('FAC Issuing Force') }}" />
                        <x-jet-input id="fac_force" class="block mt-1 w-full" type="text" name="fac_force" :value="old('fac_force')" required autocomplete="fac_force" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-jet-label for="fac_expiry" value="{{ __('FAC Expiry') }}" />
                        <x-jet-input id="fac_expiry" class="block mt-1 w-full" type="date" name="fac_expiry" :value="old('fac_expiry')" autocomplete="fac_expiry" />
                    </div>
                </div>
                <div class="md:flex flex-grow gap-2">
                    <div class="mt-4 w-full">
                        <x-jet-label for="sgc_number" value="{{ __('SGC Number') }}" />
                        <x-jet-input id="sgc_number" class="block mt-1 w-full" type="text" name="sgc_number" :value="old('sgc_number')" required autocomplete="sgc_number" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-jet-label for="sgc_force" value="{{ __('SGC Issuing Force') }}" />
                        <x-jet-input id="sgc_force" class="block mt-1 w-full" type="text" name="sgc_force" :value="old('sgc_force')" required autocomplete="sgc_force" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-jet-label for="sgc_expiry" value="{{ __('SGC Expiry') }}" />
                        <x-jet-input id="sgc_expiry" class="block mt-1 w-full" type="date" name="sgc_expiry" :value="old('sgc_expiry')" autocomplete="sgc_expiry" />
                    </div>
                </div>
                <div class="mt-4">
                    <x-jet-label for="certificate_refused" value="{{ __('Have you ever been refused a FAC or SGC? Please provide details.') }}" />
                    <x-jet-input id="certificate_refused" class="block mt-1 w-full" type="text" name="certificate_refused" :value="old('certificate_refused')" required autocomplete="certificate_refused" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="certificate_prevented" value="{{ __('Do you know of any reasons why you would not be granted a FAC/SGC? Please provide details.') }}" />
                    <x-jet-input id="certificate_prevented" class="block mt-1 w-full" type="text" name="certificate_prevented" :value="old('certificate_prevented')" required autocomplete="certificate_prevented" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="identification_1" value="{{ __('Please provide a photo/scan of a photographic ID e.g. passport, driving license.') }}" />
                    <x-jet-input id="identification_1" class="block mt-1 w-full" type="file" name="identification_1" :value="old('identification_1')" multiple="false" required />
                </div>
                <div class="mt-4">
                    <x-jet-label for="members_known_to" value="{{ __('Please list the usernames of any members you are known to.') }}" />
                    <x-jet-input id="members_known_to" class="block mt-1 w-full" type="text" name="members_known_to" :value="old('members_known_to')" required autocomplete="members_known_to" />
                </div>
                <div class="md:flex flex-grow gap-2">
                    <div class="mt-4 w-full">
                        <x-jet-label for="member_sponsor" value="{{ __('Enter the username of the member sponsoring your application.') }}" />
                        <x-jet-input id="member_sponsor" class="block mt-1 w-full" type="text" name="member_sponsor" :value="old('member_sponsor')" required autocomplete="member_sponsor" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-jet-label for="reference" value="{{ __('Please provide a reference letter from your sponsor.') }}" />
                        <x-jet-input id="reference" class="block mt-1 w-full" type="file" name="reference" :value="old('reference')" multiple="false" />
                    </div>
                </div>
                <div class="mt-4">
                    <x-jet-label for="section_21">
                        <div class="flex items-center">
                            <x-jet-checkbox name="section_21" id="section_21" required />
                            <div class="ml-2">
                                {!! __('I confirm that I am not prohibited from the possession of Firearms and/or Ammunition by virtue of section 21 of the Firearms Act of 1968 (as amended).') !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
                <div class="mt-4">
                    <x-jet-label for="signature" value="{{ __('Please provide an image of your signature.') }}" />
                    <x-jet-input id="signature" class="block mt-1 w-full" type="file" name="signature" :value="old('signature')" multiple="false" required />
                </div>
                <div class="mt-4">
                    <x-jet-label for="name" value="{{ __('Username') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
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

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-jet-button id="register-button" class="ml-4" disabled>
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
