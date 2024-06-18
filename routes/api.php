<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherContoller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


/*** STUDENT ROUTES ***/

//fetches all students
Route::get('/students', [StudentController::class, 'index']);
//creates a new student 
Route::post('/students', [StudentController::class, 'store']);
//fetch a single student
Route::get('/students/{id}', [StudentController::class, 'show']);
//update a student
Route::put('/students/{id}', [StudentController::class, 'update']);
//delete a student
Route::delete('/students/{id}', [StudentController::class, 'destroy']);


/*** TEACHER ROUTES ***/

//fetches all teachers
Route::get('/teachers', [TeacherContoller::class, 'index']);
//creates a new teacher
Route::post('/teachers', [TeacherContoller::class, 'store']);
//fetch a single teacher 
Route::get('/teachers/{id}', [TeacherContoller::class, 'show']);
//update a teacher 
Route::put('teachers/{id}', [TeacherContoller::class, 'update']);
//delete a teacher
Route::delete('teachers/{id}', [TeacherContoller::class, 'destroy']);


/*** CLASS ROUTES ***/

Route::get('/classes', [SchoolClassController::class, 'index']);
Route::post('/classes', [SchoolClassController::class, 'store']);
Route::get('/classes/{id}', [SchoolClassController::class, 'show']);
Route::put('/classes/{id}', [SchoolClassController::class, 'update']);
Route::delete('/classes/{id}', [SchoolClassController::class, 'destroy']);


/*** ENROLLMENT ROUTES ***/

Route::get('/enrollments', [EnrollmentController::class, 'index']);
Route::post('/enrollments', [EnrollmentController::class, 'store']);
Route::get('/enrollments/{id}', [EnrollmentController::class, 'show']);
Route::put('/enrollments/{id}', [EnrollmentController::class, 'update']);
Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy']);


/*** COURSE ROUTES ***/

Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::put('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

/*** GRADE ROUTES ***/

Route::get('/grades', [GradeController::class, 'index']);
Route::post('/grades', [GradeController::class, 'store']);
Route::get('/grades/{id}', [GradeController::class, 'show']);
Route::put('/grades/{id}', [GradeController::class, 'update']);
Route::delete('/grades/{id}', [GradeController::class, 'destroy']);


/*** ATTENDANCE ROUTES ***/

Route::get('/attendances', [AttendanceController::class, 'index']);
Route::post('/attendances', [AttendanceController::class, 'store']);
Route::get('/attendances/{id}', [AttendanceController::class, 'show']);
Route::put('/attendances/{id}', [AttendanceController::class, 'update']);
Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy']);