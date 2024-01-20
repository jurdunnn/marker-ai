<?php

namespace App\Models;

use App\Jobs\TranscribeImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'subject_id',
        'exam_id',
        'status_id',
        'url',
        'text',
        'tokens',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function status()
    {
        return $this->belongsTo(TranscriptionStatusType::class);
    }

    public function analysis()
    {
        return $this->hasOne(Analysis::class);
    }

    public function runVisionTranscription()
    {
        TranscribeImage::dispatch($this);
    }
}
