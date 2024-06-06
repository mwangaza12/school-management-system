<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        
        $assignments = Assignment::with('unit')->get();
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        if(auth()->user()->role == 'teacher'){
            $units = Unit::all();
            return view('assignments.create', compact('units'));
        }
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'required|date',
            'unit_id' => 'required|exists:units,id',
        ]);

        Assignment::create($request->all());

        return redirect()->route('assignments.index')
                         ->with('success', 'Assignment created successfully.');
    }

    public function show(Assignment $assignment)
    {
        return view('assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        $units = Unit::all();
        return view('assignments.edit', compact('assignment', 'units'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'required|date',
            'unit_id' => 'required|exists:units,id',
        ]);

        $assignment->update($request->all());

        return redirect()->route('assignments.index')
                         ->with('success', 'Assignment updated successfully.');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('assignments.index')
                         ->with('success', 'Assignment deleted successfully.');
    }
}
