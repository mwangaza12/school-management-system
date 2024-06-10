@extends('layouts.teachers')

@section('main-content')
<div class="container mx-auto p-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Add New Assignment</h1>
            <div class="container">
                <div class="mt-5">
                  @if ($errors->any())
                    <div class="col-12">
                      @foreach ($errors->all() as $error)
                          <div class="bg-red-500">{{ $error }}</div>
                      @endforeach
                    </div>
                      
                  @endif
              
                  @if (session()->has('error'))
                  <div class="bg-red-500">{{ session('error') }}</div>
                  @endif
              
                  @if (session()->has('success'))
                  <div class="bg-green-500">{{ session('success') }}</div>
                  @endif
                </div>
            <form action="{{ route('assignments.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="mb-4">
                    <label for="due_date" class="block text-gray-700">Due Date</label>
                    <input type="datetime-local" name="due_date" id="due_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="course_id" class="block text-gray-700">Course</label>
                    <select name="course_id" id="course_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Assignment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

