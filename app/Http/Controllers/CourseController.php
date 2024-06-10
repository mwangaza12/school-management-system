<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == 'admin'){
        $courses = DB::table('courses')
            ->join('departments', 'courses.department_id', '=', 'departments.id')
            ->select('courses.id as id', 'courses.name as name','courses.code as code', 'courses.description as description','departments.name as department_name')
            ->simplePaginate(10);
        return view('courses.index',compact('courses'));
        }elseif(Auth::user()->role == 'teacher'){
            $teacherId = Auth::user()->id; // Assuming the authenticated user is the teacher
            $teacher = User::find($teacherId);
            
            if ($teacher && $teacher->department) {
                // Get distinct courses taught in the teacher's department
                $courses = $teacher->department->courses()->distinct()->get();
                return view('courses.index', compact('courses'));
            } else {
                // Handle case where the teacher or the department is not found
                return redirect()->back()->with('error', 'Teacher or department not found');
            }
        
            return view('courses.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get(['id','name']);
        return view('courses.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'department_id' => 'required'
        ]);


        $course = Course::create($data);

        if(!$course){
            return redirect()->back()->with("error","Try again");
        }

        return redirect()->back()->with("success","Course Regitered Sucessfully");
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
        $course = Course::where('id', $id)->first();
        $departments = Department::get(['id', 'name']);
        return view('courses.edit', compact('course', 'departments'));
    }

    /**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    $validatedData = $request->validate([
        'code' => 'required',
        'name' => 'required|string|max:255',
        'description' => 'required',
        'department_id' => 'required|exists:departments,id',
        // Add other fields and validation rules as needed
    ]);

    $course = Course::findOrFail($id);
    $course->update($validatedData);

    return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
