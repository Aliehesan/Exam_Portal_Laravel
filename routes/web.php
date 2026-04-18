<?php


use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('Auth.login');
});

Route::get('/register', function () {
    return view('Auth.register');
});

Route::get('/forget-password', function () {
    return view('Auth.forget-password');
});

Route::get('/reset-password', function () {
    return view('Auth.reset-password');
});

Route::get('/user-dashboard', function () {
    \App\Models\Exam::checkAndAutoComplete();

    // 1. active exam 2. nearest scheduled exam 3. nearest pending exam
    $exam = \App\Models\Exam::with('topic')->where('status', 'active')->first();
    if (!$exam) {
        $exam = \App\Models\Exam::with('topic')->where('status', 'scheduled')->orderBy('scheduled_date', 'asc')->first();
    }
    if (!$exam) {
        $exam = \App\Models\Exam::with('topic')->where('status', 'pending')->orderBy('scheduled_date', 'asc')->first();
    }
    
    $examTitle = $exam ? $exam->title : 'No Upcoming Exam';
    $examScheduledDate = $exam ? $exam->scheduled_date : null;
    $examDuration = $exam ? $exam->duration_minutes : 60;
    $examSubject = $exam && $exam->topic ? $exam->topic->name : 'General';
    
    // Count selected questions matching exam's topic
    if ($exam) {
        $qQuery = \App\Models\Question::where('is_selected', true);
        if ($exam->topic_id) {
            $qQuery->where('topic_id', $exam->topic_id);
        }
        $questionCount = $qQuery->count();
    } else {
        $questionCount = 0;
    }

    return view('User.dashboard', compact('examTitle', 'examScheduledDate', 'examDuration', 'questionCount', 'examSubject'));
});

Route::get('/viewexam', function () {
    return view('User.Viewexam');
});

Route::get('/viewresult', function () {
    return view('User.Viewresult');
});

Route::get('/exampage', function () {
    \App\Models\Exam::checkAndAutoComplete();

    $activeExam = \App\Models\Exam::with('topic')->where('status', 'active')->first();
    
    if (!$activeExam) {
        return view('User.exam-waiting');
    }
    
    $query = \App\Models\Question::where('is_selected', true);
    if ($activeExam->topic_id) {
        $query->where('topic_id', $activeExam->topic_id);
    }
    $questions = $query->inRandomOrder()->get();
    $status = 'active';
    return view('User.Exampage', compact('questions', 'status', 'activeExam'));
});

Route::get('/dashboard', [AdminDashboardController::class, 'index']);


Route::get('/manage-topics', [TopicController::class, 'index'])->name('topics.index');
Route::post('/manage-topics', [TopicController::class, 'store'])->name('topics.store');
Route::put('/manage-topics/{id}', [TopicController::class, 'update'])->name('topics.update');
Route::delete('/manage-topics/{id}', [TopicController::class, 'destroy'])->name('topics.destroy');

// Web Routes for Questions
Route::get('/manage-questions', [QuestionController::class, 'index'])->name('questions.index');
Route::post('/manage-questions/generate', [QuestionController::class, 'generate'])->name('questions.generate');
Route::put('/manage-questions/{id}/toggle', [QuestionController::class, 'toggleSelect'])->name('questions.toggle');
Route::delete('/manage-questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');
Route::post('/manage-questions/bulk-update', [QuestionController::class, 'bulkUpdate'])->name('questions.bulkUpdate');
Route::post('/manage-questions/bulk-delete', [QuestionController::class, 'bulkDelete'])->name('questions.bulkDelete');
use App\Http\Controllers\ExamControlController;

Route::get('/manage-exams', [ExamControlController::class, 'index'])->name('exam.control');
Route::post('/manage-exams', [ExamControlController::class, 'store'])->name('exam.store');
Route::post('/manage-exams/{id}/toggle', [ExamControlController::class, 'toggleStatus'])->name('exam.toggle');
Route::delete('/manage-exams/{id}', [ExamControlController::class, 'destroy'])->name('exam.destroy');

Route::get('/manage-students', function () {
    return view('Admin.manage-students');
});
