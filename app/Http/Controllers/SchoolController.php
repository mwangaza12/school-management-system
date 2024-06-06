<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::simplePaginate(5);
        return view('schools.index',compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'abbreviation' => 'required',
            'description' => 'required'
        ]);


        $school = School::create($data);

        if(!$school){
            return redirect()->back()->with("error","Try again");
        }

        return redirect()->back()->with("success","School Regitered Sucessfully");
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
        $school = School::where('id', $id)->first();
        return view('schools.edit', compact('school'));
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
            // Add other fields and validation rules as needed
        ]);
    
        $school = School::findOrFail($id);
        $school->update($validatedData);
    
        return redirect()->route('schools.index')->with('success', 'School updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $school = School::findOrFail($id);
        $school->delete();

        return redirect()->route('schools.index')->with('success', 'School deleted successfully.');
    }
}
