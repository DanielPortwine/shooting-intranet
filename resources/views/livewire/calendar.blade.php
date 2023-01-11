<div class="flex-grow flex flex-col">
    <div class="flex gap-2 p-2 items-center">
        <x-jet-button wire:click="today">Today</x-jet-button>
        <x-jet-button wire:click="previous"><</x-jet-button>
        <x-jet-button wire:click="next">></x-jet-button>
        <p>{{ Carbon\Carbon::parse($selectedMonth)->format('M Y') }}</p>
    </div>
    <div class="grid grid-cols-7 border-t border-gray-200">
        @foreach($dayNames as $dayName)
            <p class="font-bold text-center p-2">{{ $dayName }}</p>
        @endforeach
    </div>
    <div class="
            hidden
            bg-slate-500 hover:bg-slate-600 border-slate-700
            bg-gray-500 hover:bg-gray-600 border-gray-700
            bg-zinc-500 hover:bg-zinc-600 border-zinc-700
            bg-neutral-500 hover:bg-neutral-600 border-neutral-700
            bg-stone-500 hover:bg-stone-600 border-stone-700
            bg-red-500 hover:bg-red-600 border-red-700
            bg-orange-500 hover:bg-orange-600 border-orange-700
            bg-amber-500 hover:bg-amber-600 border-amber-700
            bg-yellow-500 hover:bg-yellow-600 border-yellow-700
            bg-lime-500 hover:bg-lime-600 border-lime-700
            bg-green-500 hover:bg-green-600 border-green-700
            bg-emerald-500 hover:bg-emerald-600 border-emerald-700
            bg-teal-500 hover:bg-teal-600 border-teal-700
            bg-cyan-500 hover:bg-cyan-600 border-cyan-700
            bg-sky-500 hover:bg-sky-600 border-sky-700
            bg-blue-500 hover:bg-blue-600 border-blue-700
            bg-indigo-500 hover:bg-indigo-600 border-indigo-700
            bg-violet-500 hover:bg-violet-600 border-violet-700
            bg-purple-500 hover:bg-purple-600 border-purple-700
            bg-fuchsia-500 hover:bg-fuchsia-600 border-fuchsia-700
            bg-pink-500 hover:bg-pink-600 border-pink-700
            bg-rose-500 hover:bg-rose-600 border-rose-700
        ">
    </div>
    <div class="grid grid-cols-7 grid-auto-rows flex flex-col flex-grow">
        @foreach($days as $day => $items)
            @livewire('calendar-day-month', ['day' => $day, 'items' => $items, 'dayLoop' => $loop->index, 'lastDay' => $lastDay], key($day.count($items)))
        @endforeach
    </div>
</div>
