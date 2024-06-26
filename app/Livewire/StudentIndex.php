<?php

namespace App\Livewire;

use Livewire\Component;

class StudentIndex extends Component
{
    public function render()
    {
        return view('livewire.student-index', [
            'students' => auth()->user()->students,
        ])->layout('layouts.app');
    }
}
