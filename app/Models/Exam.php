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
        })->unique();
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

    public function getFormattedStartAtAttribute()
    {
        return $this->start_at->format('d M Y, h:i A');
    }

    public function getFormattedEndAtAttribute()
    {
        return $this->end_at->format('d M Y, h:i A');
    }

    public function getStatusAttribute()
    {
        if ($this->is_upcoming) {
            return 'Upcoming';
        }

        if ($this->is_ongoing) {
            return 'Ongoing';
        }

        if ($this->is_completed) {
            return 'Completed';
        }
    }

    public function getFormattedDurationAttribute()
    {
        return gmdate('H:i:s', $this->duration);
    }

    public function getNumberOfStudentsAttribute()
    {
        return $this->students()->count();
    }

    public function getNumberOfTranscriptsAttribute()
    {
        return $this->transcriptions()->count();
    }
}
