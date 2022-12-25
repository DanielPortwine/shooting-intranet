<div id="{{ $carousel }}" class="carousel slide relative mb-2" data-bs-ride="carousel">
    <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0">
        {{ $indicators }}
    </div>
    <div class="carousel-inner relative w-full overflow-hidden aspect-square sm:aspect-video">
        {{ $items }}
    </div>
    @if ($arrows)
        <button
            class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
            type="button"
            data-bs-target="#{{ $carousel }}"
            data-bs-slide="prev"
        >
            <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button
            class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
            type="button"
            data-bs-target="#{{ $carousel }}"
            data-bs-slide="next"
        >
            <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
</div>
