<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        // Add other fillable attributes here
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(CourseSchedule::class);
    }

    public function courses()
    {
        return $this->hasManyThrough(Course::class, CourseSchedule::class, 'teacher_id', 'id', 'id', 'course_id');
    }
}
