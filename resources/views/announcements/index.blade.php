@extends(Auth::user()->role == 'student' ? 'layouts.students' : 'layouts.admin')

@section('main-content')
@if (Auth::user()->role == 'student')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Announcements</h1>
    <table class="min-w-full bg-white border mt-4">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Title</th>
                <th class="py-2 px-4 border-b">Body</th>
                <th class="py-2 px-4 border-b">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $announcement->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $announcement->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $announcement->body }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('announcements.show', $announcement->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Show</a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
@else
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Announcements</h1>
        <a href="{{ route('announcements.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Announcement</a>

        @if ($message = Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="min-w-full bg-white border mt-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Body</th>
                    <th class="py-2 px-4 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($announcements as $announcement)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $announcement->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $announcement->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $announcement->body }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('announcements.show', $announcement->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Show</a>
                        <a href="{{ route('announcements.edit', $announcement->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection


