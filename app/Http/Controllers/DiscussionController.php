<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with('user')->latest()->paginate(10);
        return view('discussions.index', compact('discussions'));
    }

    public function create()
    {
        return view('discussions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Discussion::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('discussions.index')
                         ->with('success', 'Discussion created successfully.');
    }

    public function show(Discussion $discussion)
    {
        $discussion->load('comments.user');
        return view('discussions.show', compact('discussion'));
    }

    public function edit(Discussion $discussion)
    {
        return view('discussions.edit', compact('discussion'));
    }

    public function update(Request $request, Discussion $discussion)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $discussion->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('discussions.index')
                         ->with('success', 'Discussion updated successfully.');
    }

    public function destroy(Discussion $discussion)
    {
        $discussion->delete();

        return redirect()->route('discussions.index')
                         ->with('success', 'Discussion deleted successfully.');
    }
}

