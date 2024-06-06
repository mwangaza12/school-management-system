@extends('layouts.students')

@section('main-content')
<div class="container mx-auto p-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Schedules</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Course</th>
                            <th class="px-4 py-2 border">Teacher</th>
                            <th class="px-4 py-2 border">Start Time</th>
                            <th class="px-4 py-2 border">End Time</th>
                            <th class="px-4 py-2 border">Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td class="px-4 py-2 border">{{ $schedule->course->name }}</td>
                                <td class="px-4 py-2 border">{{ $schedule->teacher_name }}</td>
                                <td class="px-4 py-2 border">{{ $schedule->start_time }}</td>
                                <td class="px-4 py-2 border">{{ $schedule->end_time }}</td>
                                <td class="px-4 py-2 border">{{ $schedule->location }}</td>
                                
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


