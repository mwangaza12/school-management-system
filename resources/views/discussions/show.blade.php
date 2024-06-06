@extends('layouts.students')

@section('main-content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $discussion->title }}</h1>
        <p class="text-gray-600">Posted by {{ $discussion->user->name }} on {{ $discussion->created_at->format('M d, Y') }}</p>
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <p>{{ $discussion->body }}</p>
        </div>

        <h2 class="text-xl font-bold mb-4">Comments</h2>
        <div class="mt-4">
            @foreach ($discussion->comments as $comment)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <p class="text-gray-600">{{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</p>
                    <p>{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>

        <form action="{{ route('comments.store', $discussion->id) }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="body" class="block text-gray-700">Add Comment</label>
                <textarea name="body" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </form>
    </div>
@endsection

