<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    public function run()
    {
        $schools = [
            'School of Arts and Humanities',
            'School of Social Sciences',
            'School of Science',
            'School of Engineering',
            'School of Business',
            'School of Education',
            'School of Health Sciences',
            'School of Law',
            'School of Agriculture and Environmental Sciences',
            'School of Communication'
        ];

        foreach ($schools as $school) {
            School::create(['name' => $school]);
        }
    }
}

