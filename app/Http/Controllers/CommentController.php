<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Discussion;
use GuzzleHttp\Middleware;

class CommentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function store(Request $request, Discussion $discussion)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        Comment::create([
            'body' => $request->body,
            'discussion_id' => $discussion->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('discussions.show', $discussion->id)
                         ->with('success', 'Comment added successfully.');
    }
}

