<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'form_id'
    ];

    public function student():BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function form():BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
