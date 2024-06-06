@extends('layouts.students')

@section('main-content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $courseMaterial->title }}</h1>
        <p class="mb-4">{{ $courseMaterial->description }}</p>
        <p class="mb-4"><strong>Course:</strong> {{ $courseMaterial->course->name }}</p>
        <a href="{{ Storage::url($courseMaterial->file_path) }}" target="_blank" class="text-blue-500">View File</a>
        <br><br>
        <a href="{{ route('course_materials.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>
@endsection
