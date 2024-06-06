<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lecturer Dashboard') }}
            </h2>
        </x-slot>
        <div class="flex h-screen bg-gray-100">
            <div class="w-64 h-auto bg-gray-800 shadow-lg">
                <div class="flex flex-col h-full">
                    <nav class="flex-1 overflow-y-auto">
                        <ul class="mt-6 leading-10">
                            <li><a href="/dashboard" class="nav-link block px-4 py-2  text-white">Dashboard</a></li>
                            <li><a href="/courses" class="nav-link block px-4 py-2  text-white">Courses</a></li>
                            <li><a href="/students" class="nav-link block px-4 py-2  text-white">Students</a></li>
                            <li><a href="/grades" class="nav-link block px-4 py-2  text-white">Grades</a></li>
                            <li><a href="/assignments" class="nav-link block px-4 py-2 text-white">Assignment</a></li>
                            <li><a href="#" class="nav-link block px-4 py-2  text-white">Messages</a></li>
                            <li><a href="#" class="nav-link block px-4 py-2  text-white">Settings</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        @yield('main-content')
        </div>
    </x-app-layout>
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>