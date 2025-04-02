<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stream extends Model
{
    protected $fillable = [
        'name',
        'abbreviation'
    ];

    public function form(): HasMany
    {
        return $this->hasMany(Form::class);
    }
}
