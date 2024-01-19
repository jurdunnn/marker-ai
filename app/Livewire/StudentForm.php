<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentForm extends Component
{
    public ?Student $student = null;

    public bool $creating = false;

    public string $email;

    public string $name;

    public $date_of_birth;

    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|email',
        'date_of_birth' => 'required',
    ];

    public function mount()
    {
        $this->creating = !$this->student;

        if (!$this->creating) {
            $this->name = $this->student->name;
            $this->email = $this->student->email;
            $this->date_of_birth = $this->student->date_of_birth;
        }
    }

    public function render()
    {
        return view('livewire.student-form')->layout('layouts.app');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        if ($this->creating) {
            Student::create([
                'name' => $this->name,
                'email' => $this->email,
                'date_of_birth' => $this->date_of_birth,
            ]);
        } else {
            $this->student->update([
                'name' => $this->name,
                'email' => $this->email,
                'date_of_birth' => $this->date_of_birth,
            ]);
        }

        return redirect()->route('student.index');
    }
}
