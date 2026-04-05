<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::withCount('questions')->get();
        return view('Admin.manage-topics', compact('topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string'
        ]);

        Topic::create($request->all());
        return redirect()->route('topics.index')->with('success', 'Topic added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string'
        ]);

        $topic = Topic::findOrFail($id);
        $topic->update($request->all());
        return redirect()->route('topics.index')->with('success', 'Topic updated successfully!');
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully!');
    }
}
