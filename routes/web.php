<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeeStructureController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/fee-structure/preview/{term}', [FeeStructureController::class, 'previewByTerm'])
    ->name('fee-structure.previewByTerm');
