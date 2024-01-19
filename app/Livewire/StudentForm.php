<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentForm extends Component
{
    public ?Student $student = null;

    public function render()
    {
        return view('livewire.student-form')->layout('layouts.app');
    }
}
