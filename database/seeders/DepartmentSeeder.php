<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            'School of Arts and Humanities' => [
                'Department of Literature',
                'Department of Fine Arts',
                'Department of History',
                'Department of Philosophy',
                'Department of Languages'
            ],
            'School of Social Sciences' => [
                'Department of Psychology',
                'Department of Sociology',
                'Department of Economics',
                'Department of Political Science',
                'Department of Anthropology'
            ],
            'School of Science' => [
                'Department of Biology',
                'Department of Chemistry',
                'Department of Physics',
                'Department of Mathematics',
                'Department of Computer Science'
            ],
            'School of Engineering' => [
                'Department of Mechanical Engineering',
                'Department of Electrical Engineering',
                'Department of Civil Engineering',
                'Department of Chemical Engineering',
                'Department of Aerospace Engineering'
            ],
            'School of Business' => [
                'Department of Management',
                'Department of Finance',
                'Department of Marketing',
                'Department of Accounting',
                'Department of Entrepreneurship'
            ],
            'School of Education' => [
                'Department of Curriculum and Instruction',
                'Department of Educational Leadership',
                'Department of Special Education',
                'Department of Counseling',
                'Department of Educational Psychology'
            ],
            'School of Health Sciences' => [
                'Department of Medicine',
                'Department of Nursing',
                'Department of Public Health',
                'Department of Pharmacy',
                'Department of Dentistry'
            ],
            'School of Law' => [
                'Department of Legal Studies',
                'Department of Criminal Law',
                'Department of Civil Law',
                'Department of International Law',
                'Department of Constitutional Law'
            ],
            'School of Agriculture and Environmental Sciences' => [
                'Department of Agriculture',
                'Department of Environmental Science',
                'Department of Forestry',
                'Department of Horticulture',
                'Department of Soil Science'
            ],
            'School of Communication' => [
                'Department of Journalism',
                'Department of Public Relations',
                'Department of Broadcasting',
                'Department of Advertising',
                'Department of Communication Studies'
            ]
        ];

        foreach ($departments as $school_name => $school_departments) {
            $school = School::where('name', $school_name)->first();
            foreach ($school_departments as $department) {
                Department::create(['name' => $department, 'school_id' => $school->id]);
            }
        }
    }
}

