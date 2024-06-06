<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = DB::table('departments')
        ->join('schools', 'departments.school_id', '=', 'schools.id')
        ->select('departments.id as id', 'departments.name as name','departments.abbreviation as abbreviation', 'departments.description as description','schools.name as school_name')
        ->simplePaginate(10);

// Pass the data to a view or return as JSON
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $school_ids = School::get(['id','name']);
        return view('departments.create',compact('school_ids'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'abbreviation' => 'required',
            'description' => 'required',
            'school_id' => 'required'
        ]);


        $department = Department::create($data);

        if(!$department){
            return redirect()->back()->with("error","Try again");
        }

        return redirect()->back()->with("success","Department Regitered Sucessfully");
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
        $department = Department::where('id', $id)->first();
        $schools = School::get(['id', 'name']);
        return view('departments.edit', compact('department','schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'abbreviation' => 'required',
            'description' => 'required',
            'school_id' => 'required|exists:schools,id',
            // Add other fields and validation rules as needed
        ]);
    
        $department = Department::findOrFail($id);
        $department->update($validatedData);
    
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Departments deleted successfully.');
    }

    public function getDepartments($school_id) {
        $departments = Department::where('school_id', $school_id)->get();
        return response()->json($departments);
    }
    
}
