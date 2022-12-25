<?php

namespace App\Http\Livewire;

use App\Models\TargetType;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TargetEdit extends Component
{
    use WithFileUploads;

    public $target;
    public $photo;
    public $showingTargetEdit = false;
    public $dropdown = false;
    public $targetTypes;
    public $deletePhoto = false;
    protected $listeners = ['refresh' => 'mount'];

    protected $rules = [
        'target.description' => ['nullable', 'string', 'max:255'],
        'target.type_id' => ['required', 'exists:target_types,id'],
        'photo' => ['nullable', 'image', 'max:2048'],
    ];

    public function mount(): void
    {
        $this->targetTypes = TargetType::get()->toArray();
    }

    public function updatedPhoto()
    {
        $this->validate();
    }

    public function update()
    {
        $this->validate();

        $this->target->update([
            'type_id' => $this->target->type_id,
            'description' => $this->target->description,
        ]);

        if ($this->deletePhoto && $this->hasMedia('target_photos')) {
            $this->target->getFirstMedia('target_photos')->delete();
        }

        if (!empty($this->photo)) {
            if ($this->target->hasMedia('target_photos')) {
                $this->target->getFirstMedia()->delete();
            }

            $photoStore = $this->photo->store('target_photos');
            $this->target->addMedia(Storage::path($photoStore))->toMediaCollection('target_photos');
        }

        $this->showingTargetEdit = false;
        $this->photo = null;
        $this->emitTo('target-card', 'refresh');
    }

    public function render()
    {
        return view('livewire.target-edit');
    }
}
