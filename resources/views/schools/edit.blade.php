@extends('layouts.admin')
@section('main-content')
<div class="flex-1 flex items-center justify-center p-8 mt-auto">
<div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-2x">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit a School</h2>
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
<form action="{{ route('schools.update', $school->id) }}" method="POST">
  @csrf
  @method('put')
  <div class="mb-4">
    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter name" value="{{ $school->name}}">
  </div>

  <div class="mb-4">
    <label for="abbreviation" class="block text-gray-700 text-sm font-bold mb-2">Abbreviation</label>
    <input type="text" id="abbreviation" name="abbreviation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter abbreviation" value="{{ $school->abbreviation}}">
  </div>

  <div class="mb-4">
    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
    <input type="text" id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Description" value="{{ $school->description}}">
  </div>

  <div class="flex items-center justify-between">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
  </div>
</form>
</div>
</div>

@endsection




