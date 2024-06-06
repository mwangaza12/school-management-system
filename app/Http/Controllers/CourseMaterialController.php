<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use App\Models\Course;
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
        $courses = Course::all();
        return view('course_materials.create', compact('courses'));
    }

    public function store(Request $request)
    {
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

    public function show(CourseMaterial $courseMaterial)
    {
        return view('course_materials.show', compact('courseMaterial'));
    }

    public function edit(CourseMaterial $courseMaterial)
    {
        $courses = Course::all();
        return view('course_materials.edit', compact('courseMaterial', 'courses'));
    }

    public function update(Request $request, CourseMaterial $courseMaterial)
    {
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

    public function destroy(CourseMaterial $courseMaterial)
    {
        Storage::disk('public')->delete($courseMaterial->file_path);
        $courseMaterial->delete();

        return redirect()->route('course_materials.index')
                         ->with('success', 'Course Material deleted successfully.');
    }
}
