<?php

namespace App\Http\Livewire;

use App\Models\Firearm;
use App\Models\Target;
use App\Models\TargetType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TargetCreate extends Component
{
    use WithFileUploads;

    public $photo;
    public $firearm_id;
    public $firearm_name;
    public $availableFirearms;
    public $description;
    public $ammunition;
    public $showingTargetCreate = false;
    public $dropdown = false;
    public $visitID;
    public $target_type;
    public $targetTypes;

    protected $rules = [
        'firearm_id' => ['nullable', 'integer', 'exists:firearms,id'],
        'firearm_name' => ['nullable', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:255'],
        'ammunition' => ['nullable', 'string', 'max:255'],
        'target_type' => ['required', 'exists:target_types,id'],
        'photo' => ['nullable', 'image', 'max:2048'],
    ];

    public function mount(): void
    {
        $this->targetTypes = TargetType::get()->toArray();
        $this->target_type = $this->targetTypes[0]['id'];
        $this->availableFirearms = Firearm::where('user_id', Auth::id())->orderBy('fac_number')->get();
    }

    public function updatedPhoto()
    {
        $this->validate();
    }

    public function createTarget()
    {
        $this->validate();

        $target = Target::create([
            'user_id' => Auth::id(),
            'visit_id' => $this->visitID,
            'type_id' => $this->target_type,
            'firearm_id' => $this->firearm_id,
            'firearm_name' => $this->firearm_name,
            'description' => $this->description,
            'ammunition' => $this->ammunition,
        ]);

        if (!empty($this->photo)) {
            $photoStore = $this->photo->store('target_photos');
            $target->addMedia(Storage::path($photoStore))->toMediaCollection('target_photos');
        }

        $this->showingTargetCreate = false;
        $this->firearm_name = '';
        $this->description = '';
        $this->ammunition = '';
        $this->photo = null;
        $this->emitTo('visit-show', 'refresh', $this->visitID);
        $this->emitTo('visit-card', 'refresh');
        $this->emitTo('target-create', 'created');
    }

    public function render()
    {
        return view('livewire.target-create');
    }
}
