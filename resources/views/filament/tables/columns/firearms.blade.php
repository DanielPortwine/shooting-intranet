<div class="filament-tables-text-column px-4 py-3">
    {{ implode(', ', $getRecord()->firearms->pluck('fac_number')->toArray()) ?: 'Club Gun' }}
</div>
