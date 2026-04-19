<?php

use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamControlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $role = strtolower(trim(Auth::user()->role));
        return ($role === 'admin' || $role === 'faculty')
            ? redirect('/dashboard')
            : redirect('/user-dashboard');
    }
    return redirect('/login');
});

Route::get('/login', function () {
    if (Auth::check()) {
        $role = strtolower(trim(Auth::user()->role));
        return ($role === 'admin' || $role === 'faculty')
            ? redirect('/dashboard')
            : redirect('/user-dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/forget-password', function () {
    return view('auth.forget-password');
});

Route::middleware('auth')->group(function () {

    // ── STUDENT ROUTES ──
    Route::group([], function () {
        // Shared check for all student routes
        $studentCheck = function () {
            $role = strtolower(trim(Auth::user()->role));
            if ($role !== 'student') {
                return ($role === 'admin' || $role === 'faculty') ? redirect('/dashboard') : redirect('/login');
            }
            return null;
        };

        Route::get('/user-dashboard', function () use ($studentCheck) {
            if ($redir = $studentCheck())
                return $redir;
            \App\Models\Exam::checkAndAutoComplete();

            $exam = \App\Models\Exam::with('topic')->where('status', 'active')->first()
                ?? \App\Models\Exam::with('topic')->where('status', 'scheduled')->orderBy('scheduled_date', 'asc')->first()
                ?? \App\Models\Exam::with('topic')->where('status', 'pending')->orderBy('scheduled_date', 'asc')->first();

            $examTitle = $exam ? $exam->title : 'No Upcoming Exam';
            $examScheduledDate = $exam ? $exam->scheduled_date : null;
            $examDuration = $exam ? $exam->duration_minutes : 60;
            $examSubject = $exam && $exam->topic ? $exam->topic->name : 'General';

            $questionCount = 0;
            if ($exam) {
                $questionCount = \App\Models\Question::where('is_selected', true)
                    ->when($exam->topic_id, fn($q) => $q->where('topic_id', $exam->topic_id))
                    ->count();
            }

            $userId = \Auth::id();
            $results = \App\Models\ExamResult::where('user_id', $userId)->latest()->get();
            $totalAttempted = $results->count();
            $passedCount = $results->where('passed', true)->count();
            $avgScore = $totalAttempted > 0 ? round($results->avg('score')) : 0;
            $recentResults = $results->take(5);

            return view('User.dashboard', compact(
                'examTitle',
                'examScheduledDate',
                'examDuration',
                'questionCount',
                'examSubject',
                'totalAttempted',
                'passedCount',
                'avgScore',
                'recentResults'
            ));
        });

        Route::get('/viewexam', function () use ($studentCheck) {
            if ($redir = $studentCheck())
                return $redir;
            \App\Models\Exam::checkAndAutoComplete();
            $exams = \App\Models\Exam::with('topic')->get();

            $formattedExams = $exams->map(function ($exam) {
                $statusMap = [
                    'active' => 'available',
                    'scheduled' => 'upcoming',
                    'pending' => 'upcoming',
                    'completed' => 'completed',
                ];

                $result = \App\Models\ExamResult::where('exam_id', $exam->id)->where('user_id', \Auth::id())->latest()->first();
                $attempts = \App\Models\ExamResult::where('exam_id', $exam->id)->where('user_id', \Auth::id())->count();
                $isCompleted = $result !== null || $exam->status === 'completed';
                $totalQuestions = \App\Models\Question::where('topic_id', $exam->topic_id)->where('is_selected', true)->count();
                $totalMarks = $totalQuestions; // 1 mark per question
                $passingMarks = ceil($totalMarks * 0.35); // 35% to pass

                return [
                    'id' => $exam->id,
                    'title' => $exam->title,
                    'code' => 'EX-' . str_pad($exam->id, 3, '0', STR_PAD_LEFT),
                    'subject' => $exam->topic ? $exam->topic->name : 'General',
                    'questions' => $totalQuestions,
                    'duration' => $exam->duration_minutes . ' min',
                    'marks' => $totalMarks,
                    'pass' => $passingMarks,
                    'passing_pct' => '35%',
                    'deadline' => $exam->scheduled_date ? \Carbon\Carbon::parse($exam->scheduled_date)->format('M d, Y h:i A') : 'N/A',
                    'status' => $isCompleted ? 'completed' : ($statusMap[$exam->status] ?? 'upcoming'),
                    'color' => 'primary',
                    'icon' => 'feather-file-text',
                    'attempts' => $attempts,
                    'max_attempts' => 5,
                    'difficulty' => 'Medium',
                    'diff_color' => 'warning',
                    'score' => $result ? $result->score : null,
                    'passed' => $result ? (bool) $result->passed : null,
                    'has_attempted' => $attempts > 0,
                ];
            });

            return view('User.Viewexam', ['exams' => $formattedExams, 'topics' => \App\Models\Topic::all()]);
        });

        Route::get('/viewresult', function () use ($studentCheck) {
            if ($redir = $studentCheck())
                return $redir;
            $results = \App\Models\ExamResult::where('user_id', \Auth::id())->with('exam.topic')->get();
            return view('User.Viewresult', compact('results'));
        });

        Route::get('/export-results', function () use ($studentCheck) {
            if ($redir = $studentCheck())
                return $redir;
            
            $user = \Auth::user();
            $results = \App\Models\ExamResult::where('user_id', $user->id)
                ->with('exam.topic')
                ->latest()
                ->get();

            return view('User.results-pdf', compact('user', 'results'));
        });

        Route::get('/exampage/{id?}', function ($id = null) use ($studentCheck) {
            if ($redir = $studentCheck())
                return $redir;
            \App\Models\Exam::checkAndAutoComplete();
            
            $activeExam = $id ? \App\Models\Exam::with('topic')->find($id) : \App\Models\Exam::with('topic')->where('status', 'active')->first();

            if (!$activeExam)
                return view('User.exam-waiting');

            // Prevent re-taking ONLY if they have reached the max attempts
            $attempts = \App\Models\ExamResult::where('exam_id', $activeExam->id)
                ->where('user_id', \Auth::id())
                ->count();
            
            $maxAttempts = 5;

            if ($attempts >= $maxAttempts) {
                $lastResult = \App\Models\ExamResult::where('exam_id', $activeExam->id)
                    ->where('user_id', \Auth::id())
                    ->latest()
                    ->first();
                
                if ($lastResult) {
                    return redirect('/review/' . $lastResult->id)->with('info', 'You have reached the maximum attempt limit for this exam.');
                }
            }

            $questions = \App\Models\Question::where('is_selected', true)
                ->when($activeExam->topic_id, fn($q) => $q->where('topic_id', $activeExam->topic_id))
                ->inRandomOrder()->get();

            return view('User.Exampage', compact('questions', 'activeExam'));
        });

        Route::get('/review/{id}', function ($id) use ($studentCheck) {
            if ($redir = $studentCheck())
                return $redir;
            $result = \App\Models\ExamResult::where('id', $id)->where('user_id', \Auth::id())->with('exam.topic')->firstOrFail();
            $userAnswers = \App\Models\UserAnswer::where('exam_result_id', $result->id)
                ->where('user_id', \Auth::id())
                ->with('question')
                ->get();

            return view('User.Review', compact('result', 'userAnswers'));
        });

        Route::get('/change-password', function () use ($studentCheck) {
            if ($redir = $studentCheck())
                return $redir;
            return view('User.change-password');
        });

        Route::post('/change-password', function (\Illuminate\Http\Request $request) use ($studentCheck) {
            if ($redir = $studentCheck())
                return $redir;
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if (!\Hash::check($request->current_password, auth()->user()->password)) {
                return back()->withErrors(['current_password' => 'Current password does not match.']);
            }

            auth()->user()->update(['password' => \Hash::make($request->new_password)]);
            return back()->with('success', 'Password updated successfully!');
        })->name('password.update');

        Route::post('/submit-exam', function (\Illuminate\Http\Request $request) {
            $role = strtolower(trim(Auth::user()->role));
            if ($role !== 'student')
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);

            $examId = $request->exam_id;
            $answers = (array) ($request->answers ?? []);
            $userId = \Auth::id();

            $exam = \App\Models\Exam::find($examId);
            if (!$exam)
                return response()->json(['success' => false], 404);

            // Fetch ALL questions that should have been in this exam attempt
            $allExamQuestions = \App\Models\Question::where('is_selected', true)
                ->when($exam->topic_id, fn($q) => $q->where('topic_id', $exam->topic_id))
                ->get();

            $total = $allExamQuestions->count();
            $correct = 0;

            // Calculate correct answers
            foreach ($allExamQuestions as $q) {
                $selectedOption = $answers[$q->id] ?? null;
                if ($selectedOption && strtolower($selectedOption) === strtolower($q->correct_answer)) {
                    $correct++;
                }
            }

            $score = $total > 0 ? round(($correct / $total) * 100) : 0;
            $passed = $score >= 35;

            $result = \App\Models\ExamResult::create([
                'user_id' => $userId,
                'exam_id' => $examId,
                'total_questions' => $total,
                'correct_answers' => $correct,
                'score' => $score,
                'passed' => $passed,
            ]);

            // Save records for EVERY question in the exam (even skipped ones)
            foreach ($allExamQuestions as $q) {
                $selectedOption = $answers[$q->id] ?? null;

                \App\Models\UserAnswer::create([
                    'user_id' => $userId,
                    'exam_id' => $examId,
                    'exam_result_id' => $result->id,
                    'question_id' => $q->id,
                    'selected_option' => $selectedOption, // Will be null if skipped
                    'is_correct' => $selectedOption && (strtolower($selectedOption) === strtolower($q->correct_answer)),
                ]);
            }

            return response()->json([
                'success' => true, 
                'score' => $score, 
                'passed' => $passed,
                'result_id' => $result->id
            ]);
        });
    });

    // ── ADMIN/FACULTY ROUTES ──
    Route::group([], function () {
        // Shared check for all admin routes
        $adminCheck = function () {
            $role = strtolower(trim(Auth::user()->role));
            if ($role !== 'admin' && $role !== 'faculty') {
                return redirect('/user-dashboard');
            }
            return null;
        };

        Route::get('/dashboard', function () use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(AdminDashboardController::class)->index();
        });

        Route::get('/manage-topics', function () use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(TopicController::class)->index();
        })->name('topics.index');

        Route::post('/manage-topics', function (\Illuminate\Http\Request $request) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(TopicController::class)->store($request);
        })->name('topics.store');

        Route::put('/manage-topics/{id}', function (\Illuminate\Http\Request $request, $id) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(TopicController::class)->update($request, $id);
        })->name('topics.update');

        Route::delete('/manage-topics/{id}', function ($id) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(TopicController::class)->destroy($id);
        })->name('topics.destroy');

        Route::get('/manage-questions', function (\Illuminate\Http\Request $request) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(QuestionController::class)->index($request);
        })->name('questions.index');

        Route::put('/manage-questions/{id}/toggle', function (\Illuminate\Http\Request $request, $id) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(QuestionController::class)->toggleSelect($request, $id);
        })->name('questions.toggle');

        Route::delete('/manage-questions/{id}', function ($id) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(QuestionController::class)->destroy($id);
        })->name('questions.destroy');

        Route::post('/manage-questions/bulk-update', function (\Illuminate\Http\Request $request) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(QuestionController::class)->bulkUpdate($request);
        })->name('questions.bulkUpdate');

        Route::post('/manage-questions/bulk-delete', function (\Illuminate\Http\Request $request) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(QuestionController::class)->bulkDelete($request);
        })->name('questions.bulkDelete');

        Route::post('/manage-questions/generate', function (\Illuminate\Http\Request $request) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(QuestionController::class)->generate($request);
        })->name('questions.generate');

        Route::get('/manage-exams', function () use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(ExamControlController::class)->index();
        })->name('exam.control');

        Route::post('/manage-exams', function (\Illuminate\Http\Request $request) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(ExamControlController::class)->store($request);
        })->name('exam.store');

        Route::post('/manage-exams/{id}/toggle', function (\Illuminate\Http\Request $request, $id) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(ExamControlController::class)->toggleStatus($request, $id);
        })->name('exam.toggle');

        Route::delete('/manage-exams/{id}', function ($id) use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return app(ExamControlController::class)->destroy($id);
        })->name('exam.destroy');

        Route::get('/manage-students', function () use ($adminCheck) {
            if ($redir = $adminCheck())
                return $redir;
            return view('Admin.manage-students');
        });
    });
});
