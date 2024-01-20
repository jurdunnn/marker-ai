<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentShow extends Component
{
    public Student $student;

    public function render()
    {
        return view('livewire.student-show')->layout('layouts.app');
    }
}
