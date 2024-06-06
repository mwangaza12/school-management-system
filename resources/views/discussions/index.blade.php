@extends('layouts.students')

@section('main-content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Discussions</h1>
        <a href="{{ route('discussions.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Discussion</a>

        @if ($message = Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="mt-4">
            @foreach ($discussions as $discussion)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <h2 class="text-xl font-bold"><a href="{{ route('discussions.show', $discussion->id) }}">{{ $discussion->title }}</a></h2>
                    <p class="text-gray-600">Posted by {{ $discussion->user->name }} on {{ $discussion->created_at->format('M d, Y') }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $discussions->links() }}
        </div>
    </div>
@endsection

