<div>
    <x-slot name="header">
        <div class="flex gap-2 items-center">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight flex-grow">
                {{ $competition->title }} - {{ $competition->date->format('d M Y H:i') }}
            </h1>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto my-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold">Overall</h2>
            <div class="divide-y divide-gray-300">
                <div class="grid grid-cols-6">
                    <h3 class="font-semibold">Shooter</h3>
                    <h3 class="font-semibold">Time</h3>
                    <h3 class="font-semibold">Points</h3>
                    <h3 class="font-semibold">Penalties</h3>
                    <h3 class="font-semibold">Score</h3>
                    <h3 class="font-semibold">Percentage</h3>
                </div>
                @foreach($shootersOverall as $shooter)
                    <div class="grid grid-cols-6">
                        <p>{{ $shooter->name }}</p>
                        @if($shooter->stages->count() === 0 || $shooter->stages->sum('pivot.time') !== 0)
                            <p>{{ decimalise($shooter->stages->sum('pivot.time')) }}s</p>
                            <p>{{ $shooter->stages->sum('pivot.points') }}</p>
                            <p>{{ $shooter->stages->sum('pivot.penalties') }}</p>
                            <p>{{ $shooter->stages->sum('pivot.score') }}</p>
                            <p>{{ round(($shooter->stages->sum('pivot.score') / $shootersOverall->first()->stages->sum('pivot.score')) * 100, 2) }}%</p>
                        @else
                            @for($x = 0; $x < 6; $x++)
                                <p>No Score</p>
                            @endfor
                        @endif
                    </div>
                @endforeach
            </div>
            @foreach($competition->stages as $stage)
                <h2 class="text-xl font-semibold mt-2">{{ $stage->title }}</h2>
                <div class="divide-y divide-gray-300">
                    <div class="grid grid-cols-6">
                        <h3 class="font-semibold">Shooter</h3>
                        <h3 class="font-semibold">Time</h3>
                        <h3 class="font-semibold">Points</h3>
                        <h3 class="font-semibold">Penalties</h3>
                        <h3 class="font-semibold">Score</h3>
                        <h3 class="font-semibold">Percentage</h3>
                    </div>
                    @foreach($stage->shooters->sortByDesc('pivot.score') as $shooter)
                        <div class="grid grid-cols-6">
                            <p>{{ $shooter->name }}</p>
                            @if($shooter->pivot->score !== null)
                                <p>{{ decimalise($shooter->pivot->time) }}s</p>
                                <p>{{ $shooter->pivot->points }}</p>
                                <p>{{ $shooter->pivot->penalties }}</p>
                                <p>{{ $shooter->pivot->score }}</p>
                                <p>{{ round(($shooter->pivot->score / $stage->shooters->sortByDesc('pivot.score')->first()->pivot->score) * 100, 2) }}%</p>
                            @else
                                @for($x = 0; $x < 6; $x++)
                                    <p>No Score</p>
                                @endfor
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
