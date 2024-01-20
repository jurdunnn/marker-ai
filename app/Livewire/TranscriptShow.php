<?php

namespace App\Livewire;

use App\Models\Transcription;
use Livewire\Component;

class TranscriptShow extends Component
{
    public Transcription $transcript;

    public function render()
    {
        return view('livewire.transcript-show')->layout('layouts.app');
    }
}
