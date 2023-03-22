<div class="filament-tables-text-column px-4 py-3">
    {{ implode(', ', $getRecord()->requiredPackages->pluck('name')->toArray()) }}
</div>
