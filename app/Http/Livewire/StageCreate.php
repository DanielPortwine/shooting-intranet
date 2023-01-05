<?php

namespace App\Http\Livewire;

use App\Models\Stage;
use App\Models\Target;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class StageCreate extends Component
{
    use WithFileUploads;

    public $media;
    public $title;
    public $description;
    public $showingStageCreate = false;
    public $dropdown = false;
    public $competitionID;
    public $target_quantity;

    protected $rules = [
        'title' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:5000'],
        'target_quantity' => ['nullable', 'integer', 'min:0'],
        'media' => ['nullable', 'array', 'max:15'],
        'media.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,mp4,mov,ogv,webm,flv,m4v,mkv,avi', 'max:102400'],
    ];

    public function updatedPhoto()
    {
        $this->validate();
    }

    public function createStage()
    {
        $this->validate();

        $stage = Stage::create([
            'competition_id' => $this->competitionID,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        for ($x = 0; $x < $this->target_quantity; $x++) {
            Target::create([
                'user_id' => Auth::id(),
                'stage_id' => $stage->id,
                'type_id' => $stage->competition->target_type_id,
            ]);
        }

        if (!empty($this->media)) {
            foreach ($this->media as $mediaItem) {
                $mediaStore = $mediaItem->store('stage_media');
                $stage->addMedia(Storage::path($mediaStore))->toMediaCollection('stage_media');
            }
        }

        $this->showingStageCreate = false;
        $this->title = '';
        $this->description = '';
        $this->target_quantity = null;
        $this->media = [];
        $this->emitTo('competition-show', 'refresh', $this->competitionID);
        $this->emitTo('competition-card', 'refresh');
        $this->emitTo('stage-create', 'created');
    }

    public function render()
    {
        return view('livewire.stage-create');
    }
}
