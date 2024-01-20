<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->exams->map(function ($exam) {
            return $exam->students();
        })->flatten()->unique();
    }

    public function transcriptions()
    {
        return $this->hasMany(Transcription::class);
    }
}
