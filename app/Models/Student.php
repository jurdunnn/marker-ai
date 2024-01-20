<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        return $this->transcriptions->map(function ($transcription) {
            return $transcription->exam;
        })->unique();
    }

    public function subjects()
    {
        return $this->transcriptions->map(function ($transcription) {
            return $transcription->subject;
        })->unique();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
