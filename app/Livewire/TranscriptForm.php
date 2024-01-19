<?php

namespace App\Livewire;

use App\Models\Transcription;
use Livewire\Component;

class TranscriptForm extends Component
{
    public ?Transcription $transcription = null;

    public bool $creating = true;

    public $url;

    public $student_id;

    public $exam_id;

    public $subject_id;

    protected $rules = [
        'url' => 'required|url',
        'student_id' => 'required|exists:students,id',
        'subject_id' => 'required|exists:subjects,id',
        'exam_id' => 'required|exists:exams,id',
    ];

    public function mount()
    {
        if ($this->transcription) {
            $this->url = $this->transcription->url;
            $this->student_id = $this->transcription->student_id;
            $this->subject_id = $this->transcription->subject_id;
            $this->exam_id = $this->transcription->exam_id;
        } else {
            $this->creating = true;
        }
    }

    public function render()
    {
        return view('livewire.transcript-form')->layout('layouts.app');
    }

    public function save()
    {
        $this->validate();

        if ($this->transcription) {
            $this->transcription->update([
                'url' => $this->url,
                'user_id' => auth()->id(),
                'student_id' => $this->student_id,
                'exam_id' => $this->exam_id,
                'subject_id' => $this->subject_id,
                'status_id' => $this->transcription->status_id,
                'text' => $this->transcription->text ?? '',
                'tokens' => $this->transcription->tokens ?? 0,
            ]);
        } else {
            Transcription::create([
                'url' => $this->url,
                'user_id' => auth()->id(),
                'student_id' => $this->student_id,
                'exam_id' => $this->exam_id,
                'subject_id' => $this->subject_id,
                'status_id' => 1,
                'text' => '',
                'tokens' => 0,
            ]);
        }

        return redirect()->route('transcript.index');
    }
}
