<?php

namespace App\Livewire;

use App\Models\Transcription;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class MarkerBot extends Component
{
    use WithFileUploads;

    public array $properties = [];

    public array $files = [];

    public $listeners = ['setProperty', 'submit'];

    protected $rules = [
        'properties.subject' => 'required',
        'properties.exam' => 'required',
        'properties.student' => 'required',
        'files' => 'required|array|min:1',
    ];

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

    public function finishUpload($name, $tmpPath, $isMultiple)
    {
        $this->cleanupOldUploads();

        $files = collect($tmpPath)->map(function ($file) {
            return TemporaryUploadedFile::createFromLivewire($file);
        })->toArray();

        $this->emitSelf('upload:finished', $name, collect($files)->map->getFilename()->toArray());

        $files = array_merge($this->getPropertyValue($name), $files);

        $this->syncInput($name, $files);
    }

    public function submit()
    {
        $this->validate();

        foreach ($this->files as $file) {
            Log::info('Creating new transcript for file: ' . $file->getFilename());

            Transcription::create([
                'user_id' => auth()->id(),
                'subject_id' => $this->properties['subject'],
                'exam_id' => $this->properties['exam'],
                'student_id' => $this->properties['student'],
                'url' => $file->store('transcripts'),
                'tokens' => 0,
            ]);
        }

        $this->redirect(route('transcript.index'));
    }
}
