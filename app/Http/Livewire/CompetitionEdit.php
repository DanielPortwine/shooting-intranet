<?php

namespace App\Http\Livewire;

use App\Models\TargetType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompetitionEdit extends Component
{
    use WithFileUploads;

    public $competition;
    public $date;
    public $showingCompetitionEdit = false;
    public $media;
    public $mediaToDelete = [];
    public $refresh;
    public $targetTypes;

    protected $rules = [
        'competition.title' => ['required', 'string', 'max:255'],
        'competition.description' => ['nullable', 'string', 'max:5000'],
        'competition.date' => ['required', 'date'],
        'competition.target_type_id' => ['required', 'exists:target_types,id'],
        'competition.private' => ['boolean'],
        'media' => ['nullable', 'array', 'max:15'],
        'media.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,mp4,mov,ogv,webm,flv,m4v,mkv,avi', 'max:102400'],
    ];

    public function mount($competition): void
    {
        $this->competition = $competition;
        $this->date = Carbon::parse($competition->date)->format('Y-m-d\TH:i:s');
        $this->targetTypes = TargetType::get()->toArray();
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
            $visitMedia = $this->competition->getMedia('visit_media');
            foreach ($this->mediaToDelete as $id) {
                if (!empty($media = $visitMedia->collect()->where('id', $id)->first())) {
                    $media->delete();
                }
            }
        }

        $this->competition->update([
            'title' => $this->competition->title,
            'description' => $this->competition->description,
            'date' => $this->date,
            'target_type_id' => $this->competition->target_type_id,
            'private' => $this->competition->private,
        ]);

        if (!empty($this->media)) {
            foreach ($this->media as $mediaItem) {
                $mediaStore = $mediaItem->store('competition_media');
                $this->competition->addMedia(Storage::path($mediaStore))->toMediaCollection('competition_media');
            }
        }

        $this->showingCompetitionEdit = false;
        $this->media = [];
        $this->emitTo($this->refresh, 'refresh', ['competitionID' => $this->competition->id]);
    }

    public function render()
    {
        return view('livewire.competition-edit');
    }
}
