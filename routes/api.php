<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::options('{any}', function () {
    return response()->noContent();
})->where('any', '.*');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::post('logout', LogoutController::class);

    Route::apiResource('students', StudentController::class);
    Route::apiResource('teachers', TeacherController::class);
    Route::apiResource('classrooms', ClassroomController::class);
});

Route::post('login', LoginController::class);
