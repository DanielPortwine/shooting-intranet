@switch(explode('/', $mime)[0])
    @case('image')
        <img src="{{ $src }}" {{ $attributes }}>
        @break
    @case('video')
        <video @if(isset($fullscreen)) controls @else autoplay muted @endif {{ $attributes->merge(['loop' => '']) }}>
            <source src="{{ $src }}" type="{{ $mime }}">
        </video>
        @break
@endswitch
