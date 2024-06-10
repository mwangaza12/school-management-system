<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>
        <!-- Sidebar -->
    <div class="flex h-auto">
        <aside class="bg-gray-800 text-gray-100 flex flex-col w-64">
            <div class="px-6 py-4">
                <h2 class="text-2xl font-semibold">Admin Dashboard</h2>
            </div>
            <nav class="flex-grow px-6">
                <a href="/dashboard" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Dashboard</a>
                <a href="/users" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Users</a>
                <a href="/students" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Students</a>
                <a href="/teachers" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Teachers</a>
                <a href="/schools" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Schools</a>
                <a href="/departments" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Departments</a>
                <a href="/courses" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Courses</a>
                <a href="/announcements" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Announcements</a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Settings</a>
            </nav>
            <div class="px-6 py-4">
                <button class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">Logout</button>
            </div>
        </aside>
        @yield('main-content')
    </div>

    </x-app-layout> 
    </body>
</html>

