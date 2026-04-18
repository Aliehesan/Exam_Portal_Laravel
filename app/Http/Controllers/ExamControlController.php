<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Exam;
use App\Models\Topic;

class ExamControlController extends Controller
{
    public function index()
    {
        Exam::checkAndAutoComplete();

        $exams = Exam::with('topic')->orderBy('scheduled_date', 'desc')->get();
        $topics = Topic::all();

        // For each exam, count selected questions matching the exam's topic
        foreach ($exams as $exam) {
            $query = Question::where('is_selected', true);
            if ($exam->topic_id) {
                $query->where('topic_id', $exam->topic_id);
            }
            $exam->selected_count = $query->count();
        }

        $totalExams = $exams->count();
        $activeExams = $exams->where('status', 'active')->count();
        $scheduledExams = $exams->where('status', 'scheduled')->count();
        $completedExams = $exams->where('status', 'completed')->count();

        return view('Admin.manage-exams', compact('exams', 'topics', 'totalExams', 'activeExams', 'scheduledExams', 'completedExams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'topic_id' => 'nullable|exists:topics,id',
            'scheduled_date' => 'required|date',
            'duration_minutes' => 'required|integer|min:1'
        ]);

        Exam::create([
            'title' => $request->title,
            'topic_id' => $request->topic_id,
            'scheduled_date' => $request->scheduled_date,
            'duration_minutes' => $request->duration_minutes,
            'status' => 'scheduled'
        ]);

        return redirect()->back()->with('success', 'New Exam Created!');
    }

    public function toggleStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,scheduled,active,completed'
        ]);

        $exam = Exam::findOrFail($id);

        // Block starting if no questions are selected
        if ($request->status === 'active') {
            $query = Question::where('is_selected', true);
            if ($exam->topic_id) {
                $query->where('topic_id', $exam->topic_id);
            }
            $selectedCount = $query->count();

            if ($selectedCount === 0) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Cannot start exam! No questions are selected. Go to Manage Questions and select MCQs first.'
                ], 422);
            }

            // Only one exam can be active at a time
            Exam::where('status', 'active')->update(['status' => 'completed']);
            $exam->started_at = now();
        } elseif ($request->status === 'pending' || $request->status === 'scheduled') {
            $exam->started_at = null;
        }

        $exam->status = $request->status;
        $exam->save();

        return response()->json(['success' => true, 'status' => $exam->status]);
    }
    
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->back()->with('success', 'Exam deleted successfully!');
    }
}
