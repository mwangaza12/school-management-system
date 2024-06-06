<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('username');

        if (Auth::user()->role == 'admin') {
            // Query for admin role
            $studentsQuery = DB::table('users')
                ->select('users.id', 'users.name', 'users.username', 'users.role', 'users.email', 'departments.name as department_name', 'schools.name as school_name')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('schools', 'departments.school_id', '=', 'schools.id')
                ->where('users.role', 'student');

            // Apply search filter if search query is present
            if ($searchQuery) {
                $studentsQuery->where('users.username', 'like', '%' . $searchQuery . '%');
            }

            // Paginate the results
            $students = $studentsQuery->latest('users.created_at')->simplePaginate(10);

            return view('students.index', compact('students'));
        } elseif (Auth::user()->role == 'teacher') {
            // Query for teacher role
            $departmentId = Auth::user()->department_id;
            $students = DB::table('users')
                ->select('users.name', 'users.username', 'departments.name as department_name')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->where('users.department_id', $departmentId)
                ->where('users.role', 'student')
                ->get();

            return view('students.index', compact('students'));
        } else {
            return redirect()->back();
        }
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
}
