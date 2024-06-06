@extends('layouts.teachers')

@section('main-content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
    <form action="{{ route('grades.import') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label for="file" class="block text-sm font-medium text-gray-700">Upload Grades File</label>
            <input type="file" name="file" id="file" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <div class="flex items-center justify-between">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Import Grades
            </button>
            <a href="/export" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Download Form
            </a>
        </div>
    </form>
</div>
@endsection