<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class MarkerBot extends Component
{
    use WithFileUploads;

    public array $properties = [];

    public array $files = [];

    public $listeners = ['setProperty'];

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
}
