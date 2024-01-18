<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
    ];

    protected $casts = [
        'date_of_birth' => 'datetime',
    ];

    public function transcriptions()
    {
        return $this->hasMany(Transcription::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
