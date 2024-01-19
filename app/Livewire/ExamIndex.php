<?php

namespace App\Livewire;

use Livewire\Component;

class ExamIndex extends Component
{
    public function render()
    {
        return view('livewire.exam-index')->layout('layouts.app');
    }
}
