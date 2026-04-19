<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'user_id',
        'exam_id',
        'total_questions',
        'correct_answers',
        'score',
        'passed',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
