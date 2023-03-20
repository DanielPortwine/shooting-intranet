<div>
    <h3 class="text-lg font-semibold">Active packages:</h3>
    @if($user->approved_at)
        <p>See below a list of your current packages and their state.</p>
        @foreach($packages as $package)
            <div class="flex">
                @livewire('package-cancel', ['package' => $package, 'user' => $user], key($package->id))
                <p class="flex-grow">{{ $package->name }} - {{ $package->payments->where('user_id', $user->id)->sortByDesc('created_at')->first()->paid_at ? 'Paid' : 'Due' }}</p>
            </div>
        @endforeach
    @else
        <p>Your application is awaiting approval. Once approved, you will gain access to the rest of the app.</p>
    @endif
</div>
