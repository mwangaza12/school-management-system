<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseSchedule;
use App\Models\Course;
use App\Models\Teacher;
use DateTime;
use Faker\Factory as Faker;

class CourseScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $faker = Faker::create();

    // Retrieve all courses
    $courses = Course::all();

    // Generate a schedule for each course
    foreach ($courses as $course) {
        // Get a random teacher ID
        $teacher_id = Teacher::pluck('id')->random();

        // Generate random start time between 8 am and 6 pm
        $start_time = $faker->dateTimeBetween('08:00:00', '18:00:00');

        // Calculate end time (start_time + 3 hours)
        $end_time = clone $start_time;
        $end_time->modify('+3 hours');

        // Ensure end time does not exceed 6 pm
        $endOfDay = new DateTime($start_time->format('Y-m-d') . ' 18:00:00');
        if ($end_time > $endOfDay) {
            $end_time = $endOfDay;
        }

        // Convert to PHP DateTime objects
        $start_time = new \DateTime($start_time->format('Y-m-d H:i:s'));
        $end_time = new \DateTime($end_time->format('Y-m-d H:i:s'));

        $location = $faker->address;

        // Create schedule record for the course
        CourseSchedule::create([
            'course_id' => $course->id,
            'teacher_id' => $teacher_id,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'location' => $location,
        ]);
    }
}

}
