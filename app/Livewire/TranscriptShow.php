<?php

namespace App\Livewire;

use App\Models\Transcription;
use Livewire\Component;
use Illuminate\Support\Str;

class TranscriptShow extends Component
{
    public Transcription $transcript;

    public string $errorModal = '';

    protected $listeners = [
        'rerunTranscribe',
        'rerunAnalysis',
        'openErrorModal',
        'resetErrorModalText',
        'addToAnalysis'
    ];

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

    public function openErrorModal($text)
    {
        if (!Str::contains($this->transcript->text, $text)) {
            return;
        }

        $this->errorModal = $text;
    }

    public function resetErrorModalText()
    {
        $this->errorModal = '';
    }

    public function addToAnalysis($text)
    {
        if (str_word_count($this->errorModal) <= 4) {
            return;
        }

        $textArray = json_decode($this->transcript->analysis->text, true);

        $textArray[] = [
            'sentence' => $this->errorModal,
            'description' => $text,
        ];

        $newText = json_encode($textArray);

        $this->transcript->analysis->update([
            'text' => $newText,
        ]);
    }
}
