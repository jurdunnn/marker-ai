<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
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

    public function analysis()
    {
        return $this->hasOne(Analysis::class);
    }
}
