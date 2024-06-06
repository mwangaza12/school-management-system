<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Faker instance
        $faker = Faker::create();
        $students = User::where('role','student')->get();
        // Iterate over each student
        foreach ($students as $student) {
            $department = $student->department;
            $courses = $department->courses;

            //dd($courses);
            $grade = $faker->numberBetween(30, 100);
            foreach ($courses as $course) {
                DB::table('grades')->insert([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'grade' => $grade,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
