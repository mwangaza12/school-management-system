@extends('layouts.teachers')

@section('main-content')
<!-- Main content -->
<div class="flex-1 flex flex-col">
    <!-- Main section -->
    <main class="flex-1 bg-gray-100 py-6 px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- Course Overview Card -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2">Course Overview</h2>
                <p class="text-gray-600">You have {{$courses->count()}} courses ongoing this semester.</p>
            </div>

            <!-- Students Overview Card -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2">Students Overview</h2>
                <p class="text-gray-600">You are teaching 150 students this semester.</p>
            </div>

            <!-- Recent Messages Card -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2">Recent Messages</h2>
                <p class="text-gray-600">You have 5 new messages.</p>
            </div>
        </div>

        <!-- Courses List -->
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">Courses</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($courses as $course)
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">{{ $course->name }}</h3>
                    <a href="{{ route('teacher.course.students', ['id' => $course->id]) }}" class="text-blue-500 hover:underline">View Students</a>
                </div>
                @endforeach
            </div>
        </div>
    </main>
</div>
@endsection
