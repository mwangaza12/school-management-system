<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log; // For debugging

class FeeStructure extends Model {
    use HasFactory;
    protected $fillable = ['name', 'term', 'amount'];

}
