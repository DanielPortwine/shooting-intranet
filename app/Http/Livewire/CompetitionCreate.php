<?php

namespace App\Http\Livewire;

use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompetitionCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $date;
    public $private = false;
    public $media;
    public $showingCompetitionCreate = false;

    protected $rules = [
        'title' => ['string', 'max:255'],
        'description' => ['nullable', 'string', 'max:5000'],
        'date' => ['date'],
        'private' => ['boolean'],
        'media' => ['nullable', 'array', 'max:15'],
        'media.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,mp4,mov,ogv,webm,flv,m4v,mkv,avi', 'max:102400'],
    ];

    public function updatedPhotos()
    {
        $this->validate();
    }

    public function createCompetition()
    {
        $this->validate();

        $competition = Competition::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'private' => $this->private,
        ]);

        if (!empty($this->media)) {
            foreach ($this->media as $mediaItem) {
                $mediaStore = $mediaItem->store('competition_media');
                $competition->addMedia(Storage::path($mediaStore))->toMediaCollection('competition_media');
            }
        }

        $this->showingCompetitionCreate = false;
        $this->title = '';
        $this->description = '';
        $this->date = null;
        $this->private = false;
        $this->media = [];
        $this->emitTo('competitions-list', 'refresh');
        $this->emitTo('competitions-create', 'created');
    }

    public function render()
    {
        return view('livewire.competition-create');
    }
}
