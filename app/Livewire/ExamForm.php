<?php

namespace App\Livewire;

use App\Models\Exam;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class ExamForm extends Component
{
    public ?Exam $exam = null;

    public bool $creating = false;

    public $subject_id;

    public $name;

    public $description;

    public $status;

    public $start_at;

    public $end_at;

    public $total_marks;

    public $passing_marks;

    protected $rules = [
        'subject_id' => 'required|exists:subjects,id',
        'name' => 'required|string|max:255',
        'description' => 'string|max:255',
        'status' => 'required|string',
        'start_at' => 'required|date',
        'end_at' => 'required|date',
        'total_marks' => 'required|integer',
        'passing_marks' => 'required|integer',
    ];

    public function mount()
    {
        if ($this->exam) {
            $this->subject_id = $this->exam->subject_id;
            $this->name = $this->exam->name;
            $this->description = $this->exam->description;
            $this->start_at = $this->exam->start_at;
            $this->end_at = $this->exam->end_at;
            $this->status = $this->exam->status;
            $this->total_marks = $this->exam->total_marks;
            $this->passing_marks = $this->exam->passing_marks;
        } else {
            $this->creating = true;
        }
    }

    public function render()
    {
        return view('livewire.exam-form')->layout('layouts.app');
    }

    public function save()
    {
        $this->validate();

        $properties = [
            'subject_id' => $this->subject_id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'duration' => Date::parse($this->end_at)->diffInSeconds(Date::parse($this->start_at)),
            'total_marks' => $this->total_marks,
            'passing_marks' => $this->passing_marks,
        ];

        if ($this->creating) {
            $this->exam = Exam::create($properties);
        } else {
            $this->exam->update($properties);
        }

        return redirect()->route('exam.index');
    }
}
