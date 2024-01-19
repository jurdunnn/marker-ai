<?php

namespace App\Livewire;

use Livewire\Component;

class StudentShow extends Component
{
    public function render()
    {
        return view('livewire.student-show')->layout('layouts.app');
    }
}
