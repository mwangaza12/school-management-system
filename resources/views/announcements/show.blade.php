@extends('layouts.students')

@section('main-content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $announcement->title }}</h1>
        <p class="mb-4">{{ $announcement->body }}</p>
        <a href="{{ route('announcements.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
    </div>
@endsection


