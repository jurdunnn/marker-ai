<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\Student;
use App\Models\Transcription;
use Illuminate\Support\Collection;
use Livewire\Component;

class TestShow extends Component
{
    public Exam $exam;

    public Student $student;

    public $test;

    public function mount(Exam $exam, Student $student)
    {
        $this->exam = $exam;

        $this->student = $student;

        $this->test = Transcription::where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->get()
            ->pluck('analysed_transcript')
            ->implode(' ');
    }

    public function render()
    {
        return view('livewire.test-show')->layout('layouts.app');
    }
}
