@extends('layouts.teachers')

@section('main-content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Grade</h1>
        <form action="{{ route('grades.update', $grade->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="student_id" class="block text-gray-700">Student</label>
                <input type="text" name="student_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $student->name }}" required>
                <input type="hidden" name="student_id" value="{{ $student->id }}">
            </div>
            <div class="mb-4">
                <label for="subject" class="block text-gray-700">Course</label>
                <input type="text" name="course_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $grade->course_id }}" required>
            </div>
            <div class="mb-4">
                <label for="grade" class="block text-gray-700">Grade</label>
                <input type="number" name="grade" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $grade->grade }}" min="0" max="100" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
        </form>
    </div>
@endsection

