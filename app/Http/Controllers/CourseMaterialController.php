<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseMaterialController extends Controller
{
    public function index()
    {
        $courseMaterials = CourseMaterial::with('course')->get();
        return view('course_materials.index', compact('courseMaterials'));
    }

    public function create()
    {
        if(Auth::user()->role == 'teacher'){
            $teacherId = Auth::user()->id; // Assuming the authenticated user is the teacher
            $teacher = User::find($teacherId);
            
            if ($teacher && $teacher->department) {
                // Get distinct courses taught in the teacher's department
                $courses = $teacher->department->courses()->distinct()->get();
                return view('course_materials.create', compact('courses'));
            } else {
                // Handle case where the teacher or the department is not found
                return redirect()->back()->with('error', 'Teacher or department not found');
            }
            return view('course_materials.create', compact('courses'));
        }
        
    }

    public function store(Request $request)
    {
        if(Auth::user()->role == 'teacher'){
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx',
        ]);

        $filePath = $request->file('file')->store('course_materials', 'public');

        CourseMaterial::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('course_materials.index')
                         ->with('success', 'Course Material added successfully.');
    }
}

    public function show(CourseMaterial $courseMaterial)
    {
        return view('course_materials.show', compact('courseMaterial'));
    }

    public function edit(CourseMaterial $courseMaterial)
    {
        if(Auth::user()->role == 'teacher'){
        $courses = Course::all();
        return view('course_materials.edit', compact('courseMaterial', 'courses'));
        }
    }

    public function update(Request $request, CourseMaterial $courseMaterial)
    {
        if(Auth::user()->role == 'teacher'){
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($courseMaterial->file_path);
            $filePath = $request->file('file')->store('course_materials', 'public');
            $courseMaterial->file_path = $filePath;
        }

        $courseMaterial->update([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('course_materials.index')
                         ->with('success', 'Course Material updated successfully.');
    }
}

    public function destroy(CourseMaterial $courseMaterial)
    {
        if(Auth::user()->role == 'teacher'){
        Storage::disk('public')->delete($courseMaterial->file_path);
        $courseMaterial->delete();

        return redirect()->route('course_materials.index')
                         ->with('success', 'Course Material deleted successfully.');
    }
}
}
