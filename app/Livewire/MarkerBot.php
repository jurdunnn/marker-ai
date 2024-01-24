<?php

namespace App\Livewire;

use Livewire\Component;

class MarkerBot extends Component
{
    public function render()
    {
        return view('livewire.marker-bot', [
            'subjects' => auth()->user()->subjects,
        ])->layout('layouts.app');
    }
}
