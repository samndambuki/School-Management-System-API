<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//ensures only authenticated users can access these routes
Route::middleware('auth:sanctum')->group(function () {
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
});




