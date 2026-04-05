<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Topic;
use App\Models\Question;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalTopics = Topic::count();
        $totalQuestions = Question::count();
        $selectedQuestions = Question::where('is_selected', true)->count();
        
        return view('Admin.dashboard', compact('totalTopics', 'totalQuestions', 'selectedQuestions'));
    }
}
