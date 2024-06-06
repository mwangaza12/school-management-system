@extends('layouts.teachers')
@section('main-content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <div class="mb-4">
            <h1 class="text-2xl font-semibold text-gray-800">Course: {{ $course->name }}</h1>
        </div>

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-200 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-6">
            <p class="text-gray-700">There are {{ $studentsCount }} students enrolled in this course.</p>
        </div>

        <ul class="list-disc pl-5 space-y-2">
            @forelse($students as $student)
                <li class="text-gray-600">{{ $student->name }} : {{ $student->username }}</li>
            @empty
                <li class="text-gray-600">No students enrolled.</li>
            @endforelse
        </ul>

        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">
                Back
            </a>
        </div>
    </div>
@endsection
