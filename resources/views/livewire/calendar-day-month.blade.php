<div class="border-t @if(($dayLoop + 1) % 7 !== 0) border-r @endif border-gray-200">
    <div class="hidden h-1/3 h-1/4 h-1/5"></div>
    <div class="text-center p-1">
        <span class="rounded-lg aspect-square px-1 @if($day === $today) border-2 border-indigo-400 font-bold text-indigo-400 @endif">{{ \Carbon\Carbon::parse($day)->format('j') }}</span>
    </div>
    @foreach($items as $item)
        @livewire('calendar-item', ['item' => $item, 'dayLoop' => $dayLoop, 'lastDay' => $lastDay], key('calendar-item'.(is_array($item) ? $item['id'] : $item->id)))
    @endforeach
</div>

