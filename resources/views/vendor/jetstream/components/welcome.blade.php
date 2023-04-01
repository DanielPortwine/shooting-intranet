<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
{{--    <div>--}}
{{--        <x-jet-application-logo class="block h-12 w-auto" />--}}
{{--    </div>--}}

    <div class="mt-8 text-2xl">
        Welcome to the Shoot Hub!
    </div>

    <div class="mt-6 text-gray-500">
        Welcome to the Shoot Hub for Epic Shooting Club! We are thrilled to have you as a member of our community.<br><br>

        As a member, you now have access to a wealth of resources and information about shooting sports, including upcoming events, news, and tips to help you improve your skills.
        Our intranet is designed to provide you with a seamless and engaging experience, whether you're accessing it from your desktop, tablet, or mobile device.<br><br>

        We encourage you to explore all the features of our intranet, including our range visits system where you can share your visits and score your targets.
        You'll also find a comprehensive library of training materials, safety guidelines, and other valuable resources to help you get the most out of your shooting experience.<br><br>

        Thank you for joining our community, and we look forward to seeing you on the range!
    </div>

    <div class="mt-6 ">
        <h3 class="text-xl">Shooter Stats</h3>
        <div class="mt-2 text-gray-500">
            <p>Total Shots On Target: {{ $user->targetScores->count() }}</p>
            <p>Shots On Target By Firearm:</p>
            @foreach($user->firearms->sortByDesc(function($firearm) {
                    return $firearm->targets->sum('scores_count');
                }) as $firearm)
                <p class="ml-4">{{ $firearm->targets->sum('scores_count') }} - {{ $firearm->make }} {{ $firearm->model }}</p>
            @endforeach
            <p>Total Targets Shot: {{ $user->targets->count() }}</p>
            <p>Total Check-ins: {{ $user->checkIns->count() }}</p>
            <p>Member Since: {{ $user->approved_at->format('d M Y') }} ({{ Auth()->user()->approved_at->diffForHumans() }})</p>
            <p>Members Introduced: {{ $membersIntroduced }}</p>
        </div>
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center ml-8">
{{--            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>--}}
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{ route('firearms') }}">Firearms</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Upload your firearms so they can be logged at check-in and you can track your usage.
            </div>

            <a href="https://laravel.com/docs">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Manage Your Firearms</div>

                    <div class="ml-1 text-indigo-500">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center ml-8">
{{--            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>--}}
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://laracasts.com">Membership</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Manage your membership. Sign up for new packages, see your renewals and pay online.
            </div>

            <a href="https://laracasts.com">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>Manage Your Membership</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                </div>
            </a>
        </div>
    </div>

{{--    <div class="p-6 border-t border-gray-200">--}}
{{--        <div class="flex items-center">--}}
{{--            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>--}}
{{--            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://tailwindcss.com/">Tailwind</a></div>--}}
{{--        </div>--}}

{{--        <div class="ml-12">--}}
{{--            <div class="mt-2 text-sm text-gray-500">--}}
{{--                Laravel Jetstream is built with Tailwind, an amazing utility first CSS framework that doesn't get in your way. You'll be amazed how easily you can build and maintain fresh, modern designs with this wonderful framework at your fingertips.--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="p-6 border-t border-gray-200 md:border-l">--}}
{{--        <div class="flex items-center">--}}
{{--            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>--}}
{{--            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Authentication</div>--}}
{{--        </div>--}}

{{--        <div class="ml-12">--}}
{{--            <div class="mt-2 text-sm text-gray-500">--}}
{{--                Authentication and registration views are included with Laravel Jetstream, as well as support for user email verification and resetting forgotten passwords. So, you're free to get started what matters most: building your application.--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
