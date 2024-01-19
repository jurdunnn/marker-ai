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

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required|min:3',
    ];

    public function mount()
    {
        if ($this->subject) {
            $this->name = $this->subject->name;
            $this->description = $this->subject->description;
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
                'description' => $this->description,
            ]);
        } else {
            $this->subject->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
        }

        return redirect()->route('subject.index');
    }
}
