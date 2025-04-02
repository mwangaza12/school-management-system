<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'admission_number',
        'form_id',
        'guardian_id',
        'phone_number',
        'email',
        'address',
        'admission_date',
        'status'
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Guardian::class);
    }
}
