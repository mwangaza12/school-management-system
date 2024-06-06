<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'abbreviation',
        'description',
        'school_id'
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

     // Define the relationship between Department and Users
     public function users()
     {
         return $this->hasMany(User::class);
     }
}
