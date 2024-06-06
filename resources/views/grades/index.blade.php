@extends(Auth::user()->role == 'student' ? 'layouts.students' : 'layouts.teachers')

@section('main-content')
    @if (Auth::user()->role == 'student')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">My Grades</h1>
        <table class="min-w-full bg-white border mt-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Course Name</th>
                    <th class="py-2 px-4 border-b">Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->grades as $grade)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $grade->course->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $grade->grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Grade Book</h1>
            <a href="{{ route('grades.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Grade</a>
            <a href="{{ route('grades.upload') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload CSV</a>

            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="min-w-full bg-white border mt-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Student</th>
                        <th class="py-2 px-4 border-b">Unit</th>
                        <th class="py-2 px-4 border-b">Grade</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $grade->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $grade->username }}</td>
                            <td class="py-2 px-4 border-b">{{ $grade->course_id }}</td>
                            <td class="py-2 px-4 border-b">{{ $grade->grade }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('grades.show', $grade->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Show</a>
                                <a href="{{ route('grades.edit', $grade->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="inline">
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
