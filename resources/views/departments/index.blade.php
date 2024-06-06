@extends('layouts.admin')
@section('main-content')
<div class="flex-grow p-6">
    <header class="flex items-center justify-between py-4">
        <h1 class="text-3xl font-semibold text-gray-800">Departments</h1>
        <div class="flex items-center space-x-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"><a href="{{route('departments.create')}}">Add Department</a></button>
        </div>
    </header>
<div class="ms-auto">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Abbreviation
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Description
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        School Name
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
                @foreach($departments as $department)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{ $department->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{ $department->abbreviation }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{ $department->description }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{  $department->school_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-blue-500">
                            <a href="{{route('departments.edit',['department'=>$department->id])}}">Edit</a>
                    </td>
                    <td>
                    <form action="{{route('departments.destroy', ['department'=>$department->id])}}" method="post">
                        @csrf
                        @method('delete')
                            <input type="submit" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-red-700" value="delete">
                    </form>
                </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $departments->links() }}
    </div>
</div>

@endsection
