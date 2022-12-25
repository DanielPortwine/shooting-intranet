<div class="carousel-item @if($slide == 1)active @endif relative float-left w-full">
    {{ $item }}
    @if(!empty($caption))
        <div class="carousel-caption hidden md:block absolute text-center">
            {{ $caption }}
        </div>
    @endif
</div>
