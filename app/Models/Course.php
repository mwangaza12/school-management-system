<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function schedules()
    {
        return $this->hasMany(CourseSchedule::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id');
    }
    public function materials()
    {
        return $this->hasMany(CourseMaterial::class);
    }
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    
}
