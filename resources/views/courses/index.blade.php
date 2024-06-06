@extends(Auth::user()->role == 'teacher' ? 'layouts.teachers' : 'layouts.admin')

@section('main-content')
@if (Auth::user()->role == 'teacher')
<div class="p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Your Courses</h1>
    @foreach($courses as $course)
    <div class="bg-white shadow-md rounded p-4 mb-4">
        <h2 class="text-xl font-semibold text-gray-700">{{ $course->code }} - {{ $course->name }}</h2>
    </div>
    @endforeach
</div>
@else
<div class="flex-grow p-6">
    <header class="flex items-center justify-between py-4">
        <h1 class="text-3xl font-semibold text-gray-800">Courses</h1>
        <div class="flex items-center space-x-4">
            <a href="{{route('courses.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Course</a>
        </div>
    </header>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Code
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Description
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Department Name
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
                @foreach($courses as $course)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        {{ $course->code }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        {{ $course->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        {{ $course->description }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        {{ $course->department_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-blue-500">
                        <a href="{{route('courses.edit',['course'=>$course->id])}}">Edit</a>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-red-700">
                        <form action="{{route('courses.destroy', ['course'=>$course->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-red-700 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    </div>
</div>
@endif
@endsection
