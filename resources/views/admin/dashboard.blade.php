@extends('layouts.admin')
@section('main-content')
     <!-- Main Content -->
     <div class="flex-grow p-6">
        <header class="flex items-center justify-between py-4">
            <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
            <div class="flex items-center space-x-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"><a href="{{route('users.create')}}">Add Student</a></button>
                <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"><a href="{{route('users.create')}}">Add Teacher</a></button>
            </div>
        </header>
        
        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700">Total Students</h2>
                <p class="text-3xl font-bold text-gray-800 mt-4">{{ $totalStudents}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700">Total Teachers</h2>
                <p class="text-3xl font-bold text-gray-800 mt-4">{{ $totalTeachers}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700">Total Departments</h2>
                <p class="text-3xl font-bold text-gray-800 mt-4">{{ $departments}}</p>
            </div>
        </div>
        
        <!-- Students Table -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Recent Students</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->department_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">

                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Jane Smith</td>
                        <td class="px-6 py-4 whitespace-nowrap">11th Grade</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        </td>
                    </tr>
                    <!-- More students... -->
                </tbody>
            </table>
            {{ $students->links() }}
        </div>
    </div>
@endsection