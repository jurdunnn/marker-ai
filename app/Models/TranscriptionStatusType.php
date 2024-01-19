<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranscriptionStatusType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function transcriptions()
    {
        return $this->hasMany(Transcription::class);
    }
}
