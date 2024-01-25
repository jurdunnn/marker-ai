<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class MarkerBot extends Component
{
    public array $properties = [];

    public $listeners = ['setProperty'];

    public Collection $subjects, $exams, $students;

    public function mount()
    {
        $this->subjects = auth()->user()->subjects;
        $this->exams = auth()->user()->exams();
        $this->students = auth()->user()->students;
    }

    public function render()
    {
        return view('livewire.marker-bot')->layout('layouts.app');
    }

    public function setProperty($key, $value)
    {
        $this->properties[$key] = $value;
    }
}
