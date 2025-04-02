<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'employment_date',
        'email',
        'address',
        'phone_number',
        'gender',
        'status',   
    ];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class,'subject_teacher');
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
