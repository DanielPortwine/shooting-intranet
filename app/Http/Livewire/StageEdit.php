<?php

namespace App\Http\Livewire;

use App\Models\Target;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class StageEdit extends Component
{
    use WithFileUploads;

    public $media;
    public $stage;
    public $target_quantity;
    public $showingStageEdit = false;
    public $mediaToDelete = [];

    protected $rules = [
        'stage.title' => ['required', 'string', 'max:255'],
        'stage.description' => ['nullable', 'string', 'max:5000'],
        'media' => ['nullable', 'array', 'max:15'],
        'media.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,mp4,mov,ogv,webm,flv,m4v,mkv,avi', 'max:102400'],
    ];

    public function mount(): void
    {
        $this->target_quantity = $this->stage->targets->count();
    }

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
            $stageMedia = $this->stage->getMedia('stage_media');
            foreach ($this->mediaToDelete as $id) {
                if (!empty($media = $stageMedia->collect()->where('id', $id)->first())) {
                    $media->delete();
                }
            }
        }

        $this->stage->update([
            'title' => $this->stage->title,
            'description' => $this->stage->description,
        ]);

        if ($this->target_quantity !== $this->stage->targets->count() && $this->stage->scores->count() === 0) {
            foreach ($this->stage->targets as $target) {
                $target->delete();
            }

            for ($x = 0; $x < $this->target_quantity; $x++) {
                Target::create([
                    'user_id' => Auth::id(),
                    'stage_id' => $this->stage->id,
                    'type_id' => $this->stage->competition->target_type_id,
                ]);
            }
        }

        if (!empty($this->media)) {
            foreach ($this->media as $mediaItem) {
                $mediaStore = $mediaItem->store('stage_media');
                $this->stage->addMedia(Storage::path($mediaStore))->toMediaCollection('stage_media');
            }
        }

        $this->showingStageEdit = false;
        $this->media = [];
        $this->emitTo('competition-show', 'refresh', $this->stage->competition_id);
        $this->emitTo('competition-card', 'refresh');
        $this->emitTo('stage-card', 'refresh');
        $this->emitTo('stage-create', 'created');
    }

    public function render()
    {
        return view('livewire.stage-edit');
    }
}
