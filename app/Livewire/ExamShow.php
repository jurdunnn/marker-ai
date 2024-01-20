<?php

namespace App\Livewire;

use App\Models\Exam;
use Livewire\Component;

class ExamShow extends Component
{
    public Exam $exam;

    public function render()
    {
        return view('livewire.exam-show')->layout('layouts.app');
    }
}
