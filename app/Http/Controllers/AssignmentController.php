<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        
        $assignments = Assignment::with('course')->get();
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        if(auth()->user()->role == 'teacher'){
            $teacherId = Auth::user()->id; // Assuming the authenticated user is the teacher
            $teacher = User::find($teacherId);
            
            if ($teacher && $teacher->department) {
                // Get distinct courses taught in the teacher's department
                $courses = $teacher->department->courses()->distinct()->get();
                return view('assignments.create', compact('courses'));
            } else {
                // Handle case where the teacher or the department is not found
                return redirect()->back()->with('error', 'Teacher or department not found');
            }
            return view('assignments.create', compact('courses'));
        }
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'required|date',
            'course_id' => 'required|exists:courses,id',
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
