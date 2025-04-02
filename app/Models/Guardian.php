<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'relationship',
        'address'
    ];

}
