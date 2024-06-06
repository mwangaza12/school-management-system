<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'student') {
            $departmentId = Auth::user()->department_id; 
            $department = Department::with('courses')->findOrFail($departmentId);
            $courses = $department->courses;
            $courses = Department::findOrFail($departmentId)->courses;
            
            return view('students.dashboard', compact('courses'));
        }elseif(Auth::user()->role == 'teacher'){
            $teacherId = Auth::user()->id; // Assuming the authenticated user is the teacher
            $teacher = User::find($teacherId);
            
            if ($teacher && $teacher->department) {
                // Get distinct courses taught in the teacher's department
                $courses = $teacher->department->courses()->distinct()->get();
                return view('teachers.dashboard', compact('courses'));
            } else {
                // Handle case where the teacher or the department is not found
                return redirect()->back()->with('error', 'Teacher or department not found');
            }
        
            return view('teachers.dashboard');
        
        }elseif(Auth::user()->role == 'admin'){

            $departments = Department::count();
            $students = DB::table('users')
            ->select('users.id','users.name','users.username','departments.name as department_name')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->where('users.role', 'student')
            ->simplePaginate(5);
            $totalStudents = User::where('role', 'student')->count();
            $totalTeachers = User::where('role', 'teacher')->count();
            
            return view('admin.dashboard',compact('departments','students','totalStudents','totalTeachers'));

        }
        else{
            return view('dashboard');
        }
    }
}
