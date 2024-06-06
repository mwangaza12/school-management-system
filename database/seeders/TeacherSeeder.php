<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\School;
use App\Models\Department;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all schools and departments
        $schools = School::all();
        $departments = Department::all();

        if ($schools->isEmpty() || $departments->isEmpty()) {
            $this->command->info('No schools or departments found, seeding aborted.');
            return;
        }

        // Counter to keep track of the number of teachers created
        $teacherCount = 0;

        while ($teacherCount < 20) {
            foreach ($schools as $school) {
                foreach ($departments as $department) {
                    // Generate a unique username
                    $username = strtolower(substr($school->name, 0, 3) . '/' . substr($department->name, 0, 3) . '/teacher' . $teacherCount);

                    // Create the teacher record
                    User::create([
                        'name' => $faker->name,
                        'email' => $faker->unique()->safeEmail,
                        'username' => $username,
                        'password' => Hash::make('defaultpassword'), // Hash the default password
                        'role' => 'teacher', // Set the role to 'teacher'
                        'school_id' => $school->id,
                        'department_id' => $department->id,
                    ]);

                    $teacherCount++;

                    if ($teacherCount >= 20) {
                        break 3; // Break out of all loops once 100 teachers are created
                    }
                }
            }
        }
    }
}


