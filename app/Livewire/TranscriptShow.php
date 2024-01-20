<?php

namespace App\Livewire;

use App\Models\Transcription;
use Livewire\Component;

class TranscriptShow extends Component
{
    public Transcription $transcript;

    protected $listeners = ['rerunTranscribe'];

    public function render()
    {
        return view('livewire.transcript-show')->layout('layouts.app');
    }

    public function rerunTranscribe()
    {
        if ($this->transcript->status->name !== 'Pending') {
            return;
        }

        $this->transcript->runVisionTranscription();
    }
}
