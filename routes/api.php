<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PracticeController;
use Illuminate\Http\Request;
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

Route::post('signup', [ AuthController::class, 'signup' ]);
Route::post('login', [ AuthController::class, 'login' ]);
Route::middleware(['auth:api'])->get('auth/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->group(function(){
    Route::post('get-all-courses', [ CourseController::class, 'get_all_courses' ]);
    Route::post('courses/{slug}', [ CourseController::class, 'get_course' ]);
    Route::post('lessons/{course}', [ LessonController::class, 'get_lessons' ]);
    Route::post('practices/{lesson_id}', [ PracticeController::class, 'get_practices' ]);
});
