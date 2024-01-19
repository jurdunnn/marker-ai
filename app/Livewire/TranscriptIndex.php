<?php

namespace App\Livewire;

use Livewire\Component;

class TranscriptIndex extends Component
{
    public function render()
    {
        return view('livewire.transcript-index', [
            'transcripts' => auth()->user()->transcriptions,
        ])->layout('layouts.app');
    }
}
