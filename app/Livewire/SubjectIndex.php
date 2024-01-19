<?php

namespace App\Livewire;

use Livewire\Component;

class SubjectIndex extends Component
{
    public function render()
    {
        return view('livewire.subject-index')->layout('layouts.app');
    }
}
