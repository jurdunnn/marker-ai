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
        'duration' => 'datetime',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
