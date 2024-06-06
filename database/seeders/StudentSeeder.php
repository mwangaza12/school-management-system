<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\School;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
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

        for ($i = 0; $i < 100; $i++) {
            // Randomly select a school
            $school = $schools->random();
            
            // Get departments for the selected school
            $schoolDepartments = $departments->where('school_id', $school->id);

            // If no departments exist for the selected school, skip this iteration
            if ($schoolDepartments->isEmpty()) {
                continue;
            }

            // Randomly select a department within the selected school
            $department = $schoolDepartments->random();

            // Generate a unique username
            $year = rand(20, 23); // Random year between 2020 and 2023
            $uniqueNumber = $i + 1; // Unique number for each student
            $username = strtolower(substr($school->name, 0, 3) . '/' . substr($department->name, 0, 3) . '/' . str_pad($uniqueNumber, 4, '0', STR_PAD_LEFT) . '/' . $year);

            // Create the student record
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('defaultpassword'),
                'username' => $username,
                'role' => 'student',
                'school_id' => $school->id,
                'department_id' => $department->id,
            ]);
        }
    }
}


