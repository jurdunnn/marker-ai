<?php

namespace App\Livewire;

use App\Jobs\CreateTranscriptBatch;
use App\Models\Transcription;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class MarkerBot extends Component
{
    use WithFileUploads;

    public array $properties = [];

    public array $files = [];

    public $listeners = ['setProperty', 'submit'];

    protected $queryString = [
        'properties.subject' => ['except' => null, 'as' => 'subject'],
        'properties.exam' => ['except' => null, 'as' => 'exam'],
        'properties.student' => ['except' => null, 'as' => 'student'],
    ];

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

        $filePaths = collect();

        foreach ($this->files as $file) {
            $storedFile = Storage::putFileAs('transcripts', $file, $file->getFilename());

            $filePaths->add(Storage::url($storedFile));
        }

        CreateTranscriptBatch::dispatch($filePaths, $this->properties);
    }
}
