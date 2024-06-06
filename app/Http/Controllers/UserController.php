<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\School;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use function Termwind\render;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')
        ->select('users.id','users.name','users.username','users.role', 'users.email', 'departments.name as department_name', 'schools.name as school_name')
        ->join('departments', 'users.department_id', '=', 'departments.id')
        ->join('schools', 'users.school_id', '=', 'schools.id')
        ->where('users.role', ['teacher', 'student']) // Filter for teacher or student role
        ->simplePaginate(5);


        return view('admin.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $schools = School::all();
        $courses = Course::all();
        //return view('admin.form', compact('departments','schools','courses'));
        return view('admin.addUser', compact('departments','schools','courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' =>  ['required' ,'email'],
            'role' => 'required',
            'school_id' => 'required',
            'department_id' => 'required',
            'password' => 'required'
        ]);

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if(!$user){
            return redirect()->back()->with("error","Registration page try again");
        }

        return redirect()->back()->with("success","Registration success");
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
        $departments = Department::get(['id', 'name']);
        $schools = School::get(['id', 'name']);
        $courses = Course::get(['id', 'name']);
        $user = User::where('id', $id)->first();
        return view('admin.edit', compact('user','departments','schools','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' =>  ['required' ,'email'],
            'role' => 'required',
            'school_id' => 'required',
            'department_id' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        $users = DB::table('users')->get();
        return view('admin.index',compact('users'));
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $users = DB::table('users')->get();
        return view('admin.index',compact('users'));
        
    }

    
}
