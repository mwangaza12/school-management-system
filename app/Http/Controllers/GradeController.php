<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\User;
use App\Imports\GradesImport;
use App\Exports\GradesExport;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class GradeController extends Controller
{
    public function index()
    {
        $departmentId = Auth::user()->department_id;
        $grades = DB::table('users')
        ->join('grades', 'users.id', '=', 'grades.student_id')
        ->join('courses', 'grades.course_id', '=', 'courses.id')
        ->select('users.username', 'grades.course_id','grades.grade','grades.id')
        ->where('users.department_id', $departmentId)
        ->where('users.role', 'student')
        ->distinct('users.id')
        ->get();
       
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        $departmentId = Auth::user()->department_id;
        $students = DB::table('users')
                ->select('users.name','users.id')
                ->where('role','student')
                ->where('department_id',$departmentId)
                ->get();
        $courses = DB::table('courses')
                ->select('courses.name','courses.id')
                ->where('department_id',$departmentId)
                ->get();
        return view('grades.create', compact('students','courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|string|max:255',
            'grade' => 'required|integer|min:0|max:100',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')
                         ->with('success', 'Grade added successfully.');
    }

    public function show(Grade $grade)
    {
        return view('grades.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        $student = User::findOrFail($grade->student_id);
        return view('grades.edit', compact('grade', 'student'));
    }


    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|string|max:255',
            'grade' => 'required|integer|min:0|max:100',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')
                         ->with('success', 'Grade updated successfully.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grades.index')
                         ->with('success', 'Grade deleted successfully.');
    }

    public function import(Request $request)
    {

        $file = $request->file('file');

        Excel::import(new GradesImport, $file);

        return redirect()->back()->with('success', 'Grades imported successfully.');
    }

    public function upload(){
        return view('grades.upload');
    }

    public function export()
    {
        Return Excel::download(new GradesExport, 'grades.xlsx');
    }
}

