@extends('layouts.teachers')

@section('main-content')
<div class="container mx-auto p-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Edit Assignment</h1>
            <form action="{{ route('assignments.update', $assignment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ $assignment->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $assignment->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="due_date" class="block text-gray-700">Due Date</label>
                    <input type="datetime-local" name="due_date" id="due_date" value="{{ $assignment->due_date->format('Y-m-d\TH:i') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="unit_id" class="block text-gray-700">Unit</label>
                    <select name="unit_id" id="unit_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ $assignment->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Assignment</button>
                    <a href="{{ route('assignments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
