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
        'addToAnalysis',
        'deleteSentence',
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
        // This tool is to select sentences, not individual words.
        if (str_word_count($this->errorModal) < 3) {
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

        $this->refreshTranscript();
    }

    public function deleteSentence($sentenceToDelete)
    {
        // Decode the existing analysis text into an array
        $textArray = json_decode($this->transcript->analysis->text, true);

        $updatedTextArray = array_filter($textArray, function ($array) use ($sentenceToDelete) {
            return $array['sentence'] !== $sentenceToDelete;
        });

        // Re-encode the updated array back into JSON
        $newText = json_encode(array_values($updatedTextArray));
        // Update the analysis text with the new JSON
        $this->transcript->analysis->update([
            'text' => $newText,
        ]);
        // Refresh the transcript to reflect the changes
        $this->refreshTranscript();
    }

    private function refreshTranscript()
    {
        $this->transcript->refresh();

        $this->transcript->analysis->refresh();
    }
}
