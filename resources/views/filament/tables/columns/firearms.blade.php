<div>
    {{ implode(', ', $getRecord()->firearms->pluck('fac_number')->toArray()) ?: 'Club Gun' }}
</div>
