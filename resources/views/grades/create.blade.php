@extends('layouts.teachers')

@section('main-content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Add Grade</h1>
        <form action="{{ route('grades.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="student_id" class="block text-gray-700">Student</label>
                <select name="student_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label for="department" class="block text-gray-700 text-sm font-bold mb-2">Course</label>
                <select id="department" name="course_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option value="">Select Department</option>
                  @foreach ($courses as $course)
                    <option value="{{ $course->id}}">{{ $course->id}} : {{ $course->name}}</option> 
                  @endforeach
                </select>
              </div>
            <div class="mb-4">
                <label for="grade" class="block text-gray-700">Grade</label>
                <input type="number" name="grade" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="0" max="100" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </form>
    </div>
@endsection

