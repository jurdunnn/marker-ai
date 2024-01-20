<?php

namespace App\Livewire;

use App\Models\Subject;
use Livewire\Component;

class SubjectShow extends Component
{
    public Subject $subject;

    public function render()
    {
        return view('livewire.subject-show')->layout('layouts.app');
    }
}
