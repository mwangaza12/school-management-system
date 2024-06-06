@extends('layouts.students')

@section('main-content')
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex-1 bg-gray-100 p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-700">Total Courses</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{$courses->count()}}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-700">Total Assignments</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2">2</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-700">Upcoming Deadlines</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2">12:00</p>
            </div>
        </div>
        
        <div class="mt-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Courses</h2>
                <ul>
                    @foreach ($courses as $course)
                        <li class="text-gray-800">{{ $course->name }}</li> 
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>
@endsection
