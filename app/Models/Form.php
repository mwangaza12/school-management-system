<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Form extends Model
{
    protected $fillable = [
        'year',
        'stream_id'
    ];

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    public function stream(): BelongsTo
    {
        return $this->BelongsTo(Stream::class);
    }
}
