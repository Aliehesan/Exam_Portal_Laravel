<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['title', 'topic_id', 'scheduled_date', 'duration_minutes', 'status', 'started_at'];

    public static function checkAndAutoComplete()
    {
        $activeExams = self::where('status', 'active')->whereNotNull('started_at')->get();
        foreach ($activeExams as $exam) {
            $endTime = \Carbon\Carbon::parse($exam->started_at)->addMinutes($exam->duration_minutes);
            if (now()->greaterThanOrEqualTo($endTime)) {
                $exam->update(['status' => 'completed']);
            }
        }
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
