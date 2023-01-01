<?php

namespace App\Http\Livewire;

use App\Models\Firearm;
use App\Models\TargetType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TargetEdit extends Component
{
    use WithFileUploads;

    public $target;
    public $photo;
    public $availableFirearms;
    public $showingTargetEdit = false;
    public $dropdown = false;
    public $targetTypes;
    public $deletePhoto = false;
    protected $listeners = ['refresh' => 'mount'];

    protected $rules = [
        'target.firearm_id' => ['nullable', 'integer', 'exists:firearms,id'],
        'target.firearm_name' => ['nullable', 'string', 'max:255'],
        'target.description' => ['nullable', 'string', 'max:255'],
        'target.ammunition' => ['nullable', 'string', 'max:255'],
        'target.type_id' => ['required', 'exists:target_types,id'],
        'photo' => ['nullable', 'image', 'max:2048'],
    ];

    public function mount(): void
    {
        $this->targetTypes = TargetType::get()->toArray();
        $this->availableFirearms = Firearm::where('user_id', Auth::id())->orderBy('fac_number')->get();
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
            'firearm_id' => $this->target->firearm_id,
            'firearm_name' => $this->target->firearm_name,
            'description' => $this->target->description,
            'ammunition' => $this->target->ammunition,
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
