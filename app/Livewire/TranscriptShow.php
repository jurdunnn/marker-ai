<?php

namespace App\Livewire;

use App\Models\Transcription;
use Livewire\Component;

class TranscriptShow extends Component
{
    public Transcription $transcript;

    protected $listeners = ['rerunTranscribe', 'rerunAnalysis'];

    public function render()
    {
        return view('livewire.transcript-show')->layout('layouts.app');
    }

    public function rerunTranscribe()
    {
        $this->transcript->runVisionTranscription();
    }

    public function rerunAnalysis()
    {
        $this->transcript->runAnalysis();
    }
}
