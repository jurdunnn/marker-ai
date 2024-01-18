<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcription_id',
        'text',
        'tokens',
    ];

    public function transcription()
    {
        return $this->belongsTo(Transcription::class);
    }

    public function getErrorsAttribute()
    {
        return json_decode($this->text, true);
    }
}
