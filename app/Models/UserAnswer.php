<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'exam_id',
        'exam_result_id',
        'question_id',
        'selected_option',
        'is_correct',
    ];

    public function examResult()
    {
        return $this->belongsTo(ExamResult::class, 'exam_result_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
