<button
    type="button"
    data-bs-target="#{{ $carousel }}"
    data-bs-slide-to="{{ $slide - 1 }}"
    @if($slide == 1)
        class="active"
        aria-current="true"
    @endif
    aria-label="Slide {{ $slide }}"
></button>
