<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Topic;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $topics = \App\Models\Topic::all();
        
        $query = Question::with('topic');
        
        if ($request->filled('topic') && $request->topic !== 'all') {
            $query->where('topic_id', $request->topic);
        }
        
        if ($request->filled('difficulty') && $request->difficulty !== 'all') {
            $query->where('difficulty', $request->difficulty);
        }
        
        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'selected') {
                $query->where('is_selected', true);
            } elseif ($request->status === 'unselected') {
                $query->where('is_selected', false);
            }
        }
        
        $questions = $query->get();
        return view('Admin.manage-questions', compact('questions', 'topics'));
    }

    public function all()
    {
        // Return JSON with topic relations
        $questions = Question::join('topics', 'questions.topic_id', '=', 'topics.id')
            ->select('questions.*', 'topics.name as topicName')
            ->get();
        return response()->json($questions);
    }

    public function toggleSelect(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->is_selected = $request->is_selected;
        $question->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return response()->json(['success' => true]);
    }

    public function bulkUpdate(Request $request)
    {
        $ids = $request->ids;
        $status = $request->status;
        Question::whereIn('id', $ids)->update(['is_selected' => $status]);
        return response()->json(['success' => true]);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        Question::whereIn('id', $ids)->delete();
        return response()->json(['success' => true]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'count' => 'required|integer|min:1|max:100',
            'difficulty' => 'required|string'
        ]);

        $topic = Topic::find($request->topic_id);
        $prompt = "Generate exactly {$request->count} multiple choice questions (MCQ) on the topic \"{$topic->name}\" with difficulty level \"{$request->difficulty}\". 

Each question must have:
- A clear question text
- 4 options labeled A, B, C, D
- The correct answer letter (A, B, C, or D)
- Difficulty level (Easy, Medium, or Hard)

Return ONLY a valid JSON array, no extra text. Format:
[
  {
    \"question\": \"What is ...?\",
    \"optionA\": \"...\",
    \"optionB\": \"...\",
    \"optionC\": \"...\",
    \"optionD\": \"...\",
    \"correctAnswer\": \"A\",
    \"difficulty\": \"Medium\"
  }
]";

        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        $response = Http::post($url, [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to reach AI service'], 500);
        }

        $data = $response->json();
        if (isset($data['error'])) {
            return response()->json(['error' => $data['error']['message']], 500);
        }

        if (!isset($data['candidates']) || empty($data['candidates'])) {
            return response()->json(['error' => 'No response from AI'], 500);
        }

        $text = $data['candidates'][0]['content']['parts'][0]['text'];
        $text = preg_replace('/```json\s*/i', '', $text);
        $text = preg_replace('/```\s*/', '', $text);
        $text = trim($text);

        $generated = json_decode($text, true);

        if (!is_array($generated) || empty($generated)) {
            return response()->json(['error' => 'Invalid AI response format'], 500);
        }

        $savedQuestions = [];
        foreach ($generated as $q) {
            $savedQuestions[] = Question::create([
                'topic_id' => $topic->id,
                'question' => $q['question'],
                'option_a' => $q['optionA'] ?? '',
                'option_b' => $q['optionB'] ?? '',
                'option_c' => $q['optionC'] ?? '',
                'option_d' => $q['optionD'] ?? '',
                'correct_answer' => $q['correctAnswer'] ?? 'A',
                'difficulty' => $q['difficulty'] ?? $request->difficulty,
                'is_selected' => false
            ]);
        }

        return response()->json($savedQuestions);
    }
}
