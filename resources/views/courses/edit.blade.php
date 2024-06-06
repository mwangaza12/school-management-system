@extends('layouts.admin')
@section('main-content')
<div class="flex-1 flex items-center justify-center p-8 mt-auto">
<div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-2x">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Add a Course</h2>
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
<form action="{{ route('courses.update', $course->id) }}" method="POST">
  @csrf
  @method('put')
  <div class="mb-4">
    <label for="code" class="block text-gray-700 text-sm font-bold mb-2">Code</label>
    <input type="text" id="code" name="code" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter code" value="{{ $course->code}}">
  </div>

  <div class="mb-4">
    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter name" value="{{ $course->name}}">
  </div>

  <div class="mb-4">
    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
    <input type="text" id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Description" value="{{ $course->description}}">
  </div>

  <div class="mb-6">
    <label for="department" class="block text-gray-700 text-sm font-bold mb-2">Department</label>
    <select id="department" name="department_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      <option value="">Select Department</option>
      @foreach ($departments as $department)
        <option value="{{ $department->id }}" {{ $department->id == $course->department_id ? 'selected' : '' }}>
          {{ $department->id }} : {{ $department->name }}
        </option>
      @endforeach
    </select>
</div>

  <div class="flex items-center justify-between">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
  </div>
</form>
</div>
</div>

@endsection



