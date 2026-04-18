<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'topic_id', 'question', 'option_a', 'option_b', 
        'option_c', 'option_d', 'correct_answer', 
        'difficulty', 'is_selected'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }
}