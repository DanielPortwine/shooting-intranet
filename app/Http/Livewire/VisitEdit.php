<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class VisitEdit extends Component
{
    use WithFileUploads;

    public $visit;
    public $showingVisitEdit;
    public $media;
    public $refresh;
    public $mediaToDelete = [];
    protected $listeners = ['refresh' => '$refresh'];

    protected $rules = [
        'visit.title' => ['required', 'string', 'max:255'],
        'visit.description' => ['nullable', 'string', 'max:255'],
        'visit.private' => ['boolean'],
        'media' => ['nullable', 'array', 'max:15'],
        'media.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,mp4,mov,ogv,webm,flv,m4v,mkv,avi', 'max:102400'],
    ];

    public function toggleDeleteMedia($id)
    {
        if (in_array($id, array_keys($this->mediaToDelete))) {
            unset($this->mediaToDelete[$id]);
        } else {
            $this->mediaToDelete[$id] = $id;
        }

        $this->emitSelf('refresh');
    }

    public function update()
    {
        $this->validate();

        if (!empty($this->mediaToDelete)) {
            $visitMedia = $this->visit->getMedia('visit_media');
            foreach ($this->mediaToDelete as $id) {
                if (!empty($media = $visitMedia->collect()->where('id', $id)->first())) {
                    $media->delete();
                }
            }
        }

        $this->visit->update([
            'title' => $this->visit->title,
            'description' => $this->visit->description,
            'private' => $this->visit->private,
        ]);

        if (!empty($this->media)) {
            foreach ($this->media as $mediaItem) {
                $mediaStore = $mediaItem->store('visit_media');
                $this->visit->addMedia(Storage::path($mediaStore))->toMediaCollection('visit_media');
            }
        }

        $this->showingVisitEdit = false;
        $this->media = [];
        $this->emitTo($this->refresh, 'refresh', ['visitID' => $this->visit->id]);
    }

    public function render()
    {
        return view('livewire.visit-edit');
    }
}
