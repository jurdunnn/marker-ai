<?php

namespace App\Livewire;

use App\Models\Subject;
use Livewire\Component;

class SubjectForm extends Component
{
    public ?Subject $subject = null;

    public $creating = false;

    public $name;

    public $description;

    public $icon;

    protected $rules = [
        'name' => 'required|min:3',
        'icon' => 'nullable',
        'description' => 'required|min:3',
    ];

    public function mount()
    {
        if ($this->subject) {
            $this->name = $this->subject->name;
            $this->description = $this->subject->description;
            $this->icon = $this->subject->icon;
        } else {
            $this->creating = true;
        }
    }

    public function render()
    {
        return view('livewire.subject-form')->layout('layouts.app');
    }

    public function save()
    {
        $this->validate();

        if ($this->creating) {
            Subject::create([
                'user_id' => auth()->id(),
                'name' => $this->name,
                'icon' => $this->icon,
                'description' => $this->description,
            ]);
        } else {
            $this->subject->update([
                'name' => $this->name,
                'icon' => $this->icon,
                'description' => $this->description,
            ]);
        }

        return redirect()->route('subject.index');
    }
}
