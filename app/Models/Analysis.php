<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcription_id',
        'analysis',
        'tokens',
    ];

    public function transcription()
    {
        return $this->belongsTo(Transcription::class);
    }
}
