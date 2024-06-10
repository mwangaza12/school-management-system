<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        if(Auth::user()->role == 'admin'){
            return view('announcements.create');
        }
        
    }

    public function store(Request $request)
    {
        if(Auth::user()->role == 'admin'){
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Announcement::create($request->all());

        return redirect()->route('announcements.index')
                         ->with('success', 'Announcement created successfully.');
    }
}

    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        if(Auth::user()->role == 'admin'){
        return view('announcements.edit', compact('announcement'));
        }
    }

    public function update(Request $request, Announcement $announcement)
    {
        if(Auth::user()->role == 'admin'){
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $announcement->update($request->all());

        return redirect()->route('announcements.index')
                         ->with('success', 'Announcement updated successfully.');
    }
    }

    public function destroy(Announcement $announcement)
    {
        if(Auth::user()->role == 'admin'){
        $announcement->delete();

        return redirect()->route('announcements.index')
                         ->with('success', 'Announcement deleted successfully.');
    }
}
}

