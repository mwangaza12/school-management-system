@extends('layouts.students')

@section('main-content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Course Material</h1>
        <form action="{{ route('course_materials.update', $courseMaterial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="course_id" class="block text-gray-700">Course</label>
                <select name="course_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ $course->id == $courseMaterial->course_id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $courseMaterial->title }}" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $courseMaterial->description }}</textarea>
            </div>
            <div class="mb-4">
                <label for="file" class="block text-gray-700">File</label>
                <input type="file" name="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <small class="text-gray-600">Leave blank if you don't want to change the file.</small>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
        </form>
    </div>
@endsection

