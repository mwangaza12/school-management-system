<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseScheduleController extends Controller
{
    public function index()
    {
        $departmentId = Auth::user()->department_id;
        $department = Department::findOrFail($departmentId);
        $courseIds = $department->courses()->pluck('id');
        $schedules = CourseSchedule::whereIn('course_id', $courseIds)
            ->with('course', 'teacher')
            ->get();
        foreach ($schedules as $schedule) {
            $teacherName = User::findOrFail($schedule->teacher_id)->name;
            $schedule->teacher_name = $teacherName;
        }
        
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $units = Course::all();
        $teachers = DB::table('users')->where('role','teacher')->get();
        return view('schedules.create', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'teacher_id' => 'required|exists:teachers,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required',
        ]);

        CourseSchedule::create($request->all());

        return redirect()->route('schedules.index')
                        ->with('success', 'Schedule created successfully.');
    }

    public function show(Course $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    public function edit(Course $schedule)
    {
        $units = Course::all();
        $teachers = DB::table('users')->where('role','teacher')->get();
        return view('schedules.edit', compact('schedule', 'units', 'teachers'));
    }

    public function update(Request $request, Course $schedule)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'teacher_id' => 'required|exists:teachers,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')
                        ->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Course $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')
                        ->with('success', 'Schedule deleted successfully.');
    }
}
