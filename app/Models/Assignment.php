<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'due_date', 'unit_id'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
