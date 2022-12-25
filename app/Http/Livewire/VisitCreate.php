<?php

namespace App\Http\Livewire;

use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class VisitCreate extends Component
{
    use WithFileUploads;

    public $description;
    public $media;
    public $showingVisitCreate = false;

    protected $rules = [
        'description' => ['string', 'max:255'],
        'media' => ['nullable', 'array', 'max:15'],
        'media.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,mp4,mov,ogv,webm,flv,m4v,mkv,avi', 'max:102400'],
    ];

    public function updatedPhotos()
    {
        $this->validate();
    }

    public function createVisit()
    {
        $this->validate();

        $visit = Visit::create([
            'user_id' => Auth::id(),
            'description' => $this->description,
        ]);

        if (!empty($this->media)) {
            foreach ($this->media as $mediaItem) {
                $mediaStore = $mediaItem->store('visit_media');
                $visit->addMedia(Storage::path($mediaStore))->toMediaCollection('visit_media');
            }
        }

        $this->showingVisitCreate = false;
        $this->description = '';
        $this->media = [];
        $this->emitTo('visits-list', 'refresh');
        $this->emitTo('visit-create', 'created');
    }

    public function render()
    {
        return view('livewire.visit-create');
    }
}
