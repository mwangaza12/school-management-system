<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GradesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $courseNames;

    public function __construct()
    {
        $departmentId = Auth::user()->department_id;
        
        $this->courseNames = DB::table('courses')
            ->join('grades', 'courses.id', '=', 'grades.course_id')
            ->join('users', 'grades.student_id', '=', 'users.id')
            ->where('users.department_id', $departmentId)
            ->pluck('courses.name')
            ->unique() // Ensure unique course names
            ->toArray();
    }

    public function collection()
    {
        $departmentId = Auth::user()->department_id;

        return DB::table('users')
            ->join('grades', 'users.id', '=', 'grades.student_id')
            ->join('courses', 'grades.course_id', '=', 'courses.id')
            ->select('users.id', 'users.username', 'grades.course_id')
            ->where('users.department_id', $departmentId)
            ->where('users.role', 'student')
            ->distinct('users.id')
            ->get();
    }

    public function headings(): array
    {
        // Static headers plus dynamic course names
        return array_merge(['Username'], $this->courseNames);
    }

    public function map($row): array
    {
        // Fetch all grades associated with the student
        $grades = DB::table('grades')
            ->join('courses', 'grades.course_id', '=', 'courses.id')
            ->where('grades.student_id', $row->id)
            ->pluck('grades.grade')
            ->toArray();

        // Ensure the grades are in the same order as headings
        $gradeData = array_fill(0, count($this->courseNames), '');

        foreach ($grades as $grade) {
            // Find the index of the corresponding course
            $index = array_search($grade, $this->courseNames);
            if ($index !== false) {
                $gradeData[$index] = $grade;
            }
        }

        // Map the student username and their grades
        return array_merge([$row->username], $gradeData);
    }
}

