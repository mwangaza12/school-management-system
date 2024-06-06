@extends(Auth::user()->role == 'teacher' ? 'layouts.teachers' : 'layouts.admin')

@section('main-content')
    @if (Auth::user()->role == 'teacher')
        <!-- Teacher view without search functionality -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->username }}</td>
                </tr>
                @endforeach
            </table>
        </div> 
    @else
        <!-- Admin view with search functionality -->
        <div class="flex-grow p-6">
            <header class="flex items-center justify-between py-4">
                <h1 class="text-3xl font-semibold text-gray-800">Students</h1>
                <div class="flex items-center space-x-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        <a href="{{ route('users.create') }}">Add Student</a>
                    </button>
                    <!-- Search form -->
                <form action="/students" method="GET">
                    <div class="flex items-center space-x-4">
                        <input type="text" name="username" placeholder="Search by username"
                               class="border border-gray-200 rounded-md px-4 py-2 focus:outline-none focus:border-blue-500">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Search
                        </button>
                    </div>
                </form>
                </div>
            </header>
            <div class="ms-auto">
                <!-- Table of students -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <!-- Table headers -->
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Username
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Department
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Edit
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($students as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $student->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $student->username }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $student->department_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-blue-500">
                                        <a href="{{ route('users.edit', ['user' => $student->id]) }}">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy', ['user' => $student->id]) }}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-red-700"
                                                   value="delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection
