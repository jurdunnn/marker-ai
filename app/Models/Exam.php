<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'name',
        'description',
        'status',
        'start_at',
        'end_at',
        'duration',
        'total_marks',
        'passing_marks',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function transcriptions()
    {
        return $this->hasMany(Transcription::class);
    }

    public function students()
    {
        return $this->transcriptions->map(function ($transcription) {
            return $transcription->student;
        });
    }

    public function user()
    {
        return $this->subject->user;
    }

    public function getIsStartedAttribute()
    {
        return $this->start_at->isPast();
    }

    public function getIsEndedAttribute()
    {
        return $this->end_at->isPast();
    }

    public function getIsOngoingAttribute()
    {
        return $this->is_started && !$this->is_ended;
    }

    public function getIsUpcomingAttribute()
    {
        return !$this->is_started;
    }

    public function getIsCompletedAttribute()
    {
        return $this->is_ended;
    }

    public function getFormattedDurationAttribute()
    {
        return gmdate('H:i:s', $this->duration);
    }
}
