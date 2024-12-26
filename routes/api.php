<?php

use App\Http\Controllers\api\AccountController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\EducationController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\ExperiencesController;
use App\Http\Controllers\api\SkillController;
use App\Http\Controllers\api\TrainingController;
use App\Http\Controllers\api\UserController;
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


Route::post('/user-registration', [UserController::class, 'storeRegistration']);
Route::post('/verify', [UserController::class, 'verify']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/job-list', [AccountController::class, 'jobList']);
Route::get('/event', [EventController::class, 'event']);
Route::get('/training', [TrainingController::class, 'training']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/account', [AccountController::class, 'account']);
    Route::post('/account', [AccountController::class, 'createOrUpdateAccount']);

    Route::post('/jobs/{job}/apply', [AccountController::class, 'applyJob']);
    Route::get('/jobs/applied', [AccountController::class, 'applyJobList']);

    Route::get('/education', [EducationController::class, 'index']); // Get all education records
    Route::post('/education', [EducationController::class, 'store']); // Add a new education record
    Route::post('/education-update/{id}', [EducationController::class, 'update']); // Update an education record
    Route::delete('/education-delete/{id}', [EducationController::class, 'destroy']); // Delete an education record

    Route::get('/experiences', [ExperiencesController::class, 'index']); // Get all experience records
    Route::post('/experiences-store', [ExperiencesController::class, 'store']); // Add a new experience record

    Route::get('/skills', [SkillController::class, 'index']); // Get all skills
    Route::post('/skills-store', [SkillController::class, 'store']); // Add a new skill

    Route::get('/category', [CategoryController::class, 'index']); // Get all skills
});
