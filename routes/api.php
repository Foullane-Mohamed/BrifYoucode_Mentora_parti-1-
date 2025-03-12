<?php
// routes/api.php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Support\Facades\Route;



// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Courses
    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

    // Enrollments
    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll']);
    Route::post('/courses/{id}/progress', [CourseController::class, 'updateProgress']);
    Route::get('/enrolled-courses', [CourseController::class, 'enrolledCourses']);
    Route::get('/my-courses', [CourseController::class, 'myCourses']);
});
