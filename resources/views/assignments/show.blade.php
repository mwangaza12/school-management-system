@extends('layouts.teachers')

@section('main-content')
<div class="container mx-auto p-4">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-3xl font-bold mb-4">{{ $assignment->title }}</h1>
                <p class="text-gray-700 mb-4"><strong>Description:</strong> {{ $assignment->description }}</p>
                <p class="text-gray-700 mb-4"><strong>Due Date:</strong> {{ $assignment->due_date}}</p>
                <p class="text-gray-700 mb-4"><strong>Unit:</strong> {{ $assignment->course->name }}</p>
                
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('assignments.edit', $assignment->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit Assignment</a>
                    <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete Assignment</button>
                    </form>
                    <a href="{{ route('assignments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back to Assignments</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
