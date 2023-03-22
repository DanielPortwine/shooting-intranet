<div class="filament-tables-text-column px-4 py-3">
    {{ implode(', ', $getRecord()->excludedPackages->pluck('name')->toArray()) }}
</div>
