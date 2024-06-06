@extends('layouts.teachers')

@section('main-content')
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl font-bold mb-4">{{ $grade->student->name }} - {{ $grade->subject }}</h1>
            <p class="mb-4"><strong>Grade:</strong> {{ $grade->grade }}</p>
            <!-- Add more details if necessary -->
            <a href="{{ route('grades.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
        </div>
    </div>
@endsection


