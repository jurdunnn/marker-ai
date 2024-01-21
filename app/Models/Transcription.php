<?php

namespace App\Models;

use App\Jobs\AnalyseTranscript;
use App\Jobs\TranscribeImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\DescriptionList\Renderer\DescriptionRenderer;

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

    protected static function booted()
    {
        static::created(function ($transcription) {
            $transcription->runVisionTranscription();
        });

        static::updated(function ($transcription) {
            if ($transcription->isDirty('text')) {
                $transcription->runAnalysis();
            }
        });
    }

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

    public function runAnalysis()
    {
        AnalyseTranscript::dispatch($this);
    }

    public function getAnalysedTranscriptAttribute()
    {
        $text = $this->text;

        if ($this->status->name !== 'Complete') {
            return $text;
        }

        if ($this->analysis) {
            foreach (json_decode($this->analysis->text, true) as $index => $error) {
                $description = htmlspecialchars($error['description'], ENT_QUOTES, 'UTF-8');

                $title = htmlspecialchars_decode($description, ENT_QUOTES);

                $text = str_replace(
                    $error['sentence'],
                    '<span id="sentence-error-' . $index . '" style="position: relative; cursor: help; color:white; background-color: #be123c;" title="' . $title . '">' . $error['sentence'] . '</span>',
                    $text
                );
            }
        }

        return $text;
    }
}
