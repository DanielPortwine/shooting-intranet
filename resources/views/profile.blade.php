<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <div class="flex flex-col sm:flex-row items-center">
                    <div class="w-full sm:w-1/3">
                        <img class="aspect-square object-cover w-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                    </div>
                    <div class="w-full sm:w-2/3 mt-4 sm:mt-0 p-4 text-center">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                            <div class="">
                                <h3>Shots</h3>
                                <i class="fa fa-crosshairs text-5xl"></i>
                                <p class="text-3xl font-bold">{{ $user->targetScores->count() }}</p>
                            </div>
                            <div class="">
                                <h3>Visits</h3>
                                <i class="fa fa-calendar-check text-5xl"></i>
                                <p class="text-3xl font-bold">{{ $user->checkIns->count() }}</p>
                            </div>
                            <div class="">
                                <h3>Targets</h3>
                                <i class="fa fa-bullseye text-5xl"></i>
                                <p class="text-3xl font-bold">{{ $user->targets->count() }}</p>
                            </div>
                            <div class="">
                                <h3>Awards</h3>
                                <i class="fa fa-trophy text-5xl"></i>
                                <p class="text-3xl font-bold">{{ 0 }}</p>
                            </div>
                        </div>
                        <div class="mt-4 px-4">Joined on {{ $user->approved_at->format('d M Y') }} ({{ $user->approved_at->diffForHumans() }})</div>
                    </div>
                </div>
            </div>
            <div class="sm:grid lg:grid-cols-3 w-full gap-6">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-6">
                    <h3 class="text-xl font-semibold mb-4 border-b">Top Firearms</h3>
                    @foreach($user->firearms->sortByDesc(function($firearm) { return $firearm->targets->sum('scores_count'); })->take(3) as $firearm)
                        <div class="flex py-4 border-b">
                            <p class="text-5xl">{{ $loop->index + 1 }}</p>
                            <div class="ml-4">
                                <p class="">{{ $firearm->make }} {{ $firearm->model }}</p>
                                <p class="">{{ $firearm->targets->sum('scores_count') }} Shots</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-6">
                    <h3 class="text-xl font-semibold mb-4 border-b">Latest Awards</h3>
                    <p class="">Coming soon...</p>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-6">
                    <h3 class="text-xl font-semibold mb-4 border-b">General Statistics</h3>
                    <p class="border-b">Shots On Target: <span class="float-right">{{ $user->targetScores->count() }}</span></p>
                    @foreach($user->firearms->sortByDesc(function($firearm) {
                            return $firearm->targets->sum('scores_count');
                        }) as $firearm)
                        <p class="ml-4 border-b">{{ $firearm->make }} {{ $firearm->model }}: <span class="float-right">{{ $firearm->targets->sum('scores_count') }}</span></p>
                    @endforeach
                    <p class="border-b">Targets Shot: <span class="float-right">{{ $user->targets->count() }}</span></p>
                    <p class="border-b">Range Visits: <span class="float-right">{{ $user->checkIns->count() }}</span></p>
                    <p class="border-b">Competitions Entered: <span class="float-right">{{ $user->competitions->count() }}</span></p>
                    <p class="border-b">Members Introduced: <span class="float-right">{{ $membersIntroduced }}</span></p>
                    <p class="border-b">Guests Hosted: <span class="float-right">{{ $user->guestDaysHosted->count() }}</span></p>
                    <p class="border-b">Guest Days Attended: <span class="float-right">{{ $user->guestDays->count() }}</span></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
