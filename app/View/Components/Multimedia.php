<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Multimedia extends Component
{
    /**
     * The src of the media.
     *
     * @var string
     */
    public string $src;

    /**
     * The mime type of the media.
     *
     * @var string
     */
    public string $mime;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($src, $mime)
    {
        $this->src = $src;
        $this->mime = $mime;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.multimedia');
    }
}
