<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = DB::table('users')
        ->select('users.id','users.name','users.username','users.role', 'users.email', 'departments.name as department_name', 'schools.name as school_name')
        ->join('departments', 'users.department_id', '=', 'departments.id')
        ->join('schools', 'departments.school_id', '=', 'schools.id')
        ->where('users.role', 'teacher')
        ->latest('users.created_at')
        ->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function showCourseStudents($courseId){
        $course = DB::table('courses')->select('name','id')->where('id',$courseId)->first();
        //dd($course->name);
        $departmentId = Auth::user()->department_id;
        $students = DB::table('users')
        ->select('users.name','users.username')
        ->where('users.department_id',$departmentId)
        ->where( 'users.role','student')
        ->get();

        $studentsCount = $students->count();
        //dd($studentsCount);
        //dd($students);
        return view('teachers.course_students',compact('students','studentsCount','course'));
        
    }
    

}
