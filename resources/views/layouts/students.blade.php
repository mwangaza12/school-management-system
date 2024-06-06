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
                {{ __('Student Dashboard') }}
            </h2>
        </x-slot>
        <div class="flex h-auto bg-gray-100">
        <div class="w-64 h-auto bg-gray-800 shadow-lg">
            <div class="flex flex-col h-full">
                <nav class="flex-1 overflow-y-auto">
                    <ul class="mt-6 leading-10">
                        <li><a href="/schedules" class="nav-link block px-4 py-2 text-white">Units Schedule</a></li>
                        <li><a href="/grades" class="nav-link block px-4 py-2 text-white">Gradebook</a></li>
                        <li><a href="/assignments" class="nav-link block px-4 py-2 text-white">Assignment Calendar</a></li>
                        <li><a href="/course_materials" class="nav-link block px-4 py-2 text-white">Course Materials</a></li>
                        <li><a href="/announcements" class="nav-link block px-4 py-2 text-white">Announcements</a></li>
                        <li><a href="/discussions" class="nav-link block px-4 py-2 text-white">Discussion Forums</a></li>
                        <li><a href="#" class="nav-link block px-4 py-2 text-white">Financial Information</a></li>
                        <li><a href="#" class="nav-link block px-4 py-2 text-white">Career Services</a></li>
                        <li><a href="#" class="nav-link block px-4 py-2 text-white">Feedback and Surveys</a></li>
                        <li><a href="#" class="nav-link block px-4 py-2 text-white">Notifications</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        @yield('main-content')
        </div>
    </x-app-layout>
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>