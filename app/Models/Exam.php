<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    protected $fillable = [
        'exam_name',
        'exam_date',
        'form_id',
        'term',
        'year'
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
