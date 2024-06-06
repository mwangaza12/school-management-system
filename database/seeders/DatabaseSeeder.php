<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // SchoolSeeder::class,
            // DepartmentSeeder::class,
            // CourseSeeder::class,
            // StudentSeeder::class,
            // TeacherSeeder::class,
            // CourseScheduleSeeder::class,
            GradeSeeder::class,
        ]);
    }
}
