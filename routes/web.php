<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseScheduleController;
use App\Http\Controllers\AssignmentController;
use App\Models\Assignment;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
});

Route::get('/admin',[AuthController::class, 'get'])->middleware(['auth','admin']);

Route::resource('users',UserController::class)->middleware(['auth','admin']);
Route::resource('students',StudentController::class)->middleware(['auth']);
Route::resource('teachers',TeacherController::class)->middleware(['auth','admin']);
Route::resource('schools',SchoolController::class)->middleware(['auth','admin']);
Route::resource('departments',DepartmentController::class)->middleware(['auth','admin']);
Route::resource('courses',CourseController::class)->middleware(['auth']);

Route::get('/trial', function(){
    return view('trial.trial');
});

Route::get('/departments/{school_id}', 'DepartmentController@getDepartments');

Route::resource('schedules', CourseScheduleController::class);
Route::resource('assignments', AssignmentController::class);
Route::resource('announcements', AnnouncementController::class);
Route::resource('grades', GradeController::class);
Route::resource('course_materials', CourseMaterialController::class);
Route::resource('discussions', DiscussionController::class);
Route::post('discussions/{discussion}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::middleware(['auth'])->group(function () {
    Route::resource('discussions', DiscussionController::class);
    Route::post('discussions/{discussion}/comments', [CommentController::class, 'store'])->name('comments.store');
});



Route::get('/api/assignments', function() {
    return Assignment::with('course')
        ->get()
        ->map(function($assignment) {
            return [
                'id' => $assignment->id,
                'title' => $assignment->title . ' (' . $assignment->unit->name . ')',
                'start' => $assignment->due_date,
            ];
        });
});

Route::get('/upload',[GradeController::class,'upload'])->name('grades.upload');
Route::post('/grades/import', [GradeController::class, 'import'])->name('grades.import');
Route::get('/export', [GradeController::class, 'export']);
Route::get('/teacher/course/{id}/students', [TeacherController::class, 'showCourseStudents'])->name('teacher.course.students');

