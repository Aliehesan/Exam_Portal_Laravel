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
    return view('User.dashboard');
});

Route::get('/viewexam', function () {
    return view('User.Viewexam');
});

Route::get('/viewresult', function () {
    return view('User.Viewresult');
});

Route::get('/exampage', function () {
    return view('User.Exampage');
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

Route::get('/manage-students', function () {
    return view('Admin.manage-students');
});
