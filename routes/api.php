<?php
// routes/api.php
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;



// Routes pour les cours
Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::put('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
Route::get('/categories/{categoryId}/courses', [CourseController::class, 'coursesByCategory']);
Route::post('/courses/{courseId}/tags', [CourseController::class, 'attachTags']);
Route::delete('/courses/{courseId}/tags', [CourseController::class, 'detachTags']);

// Routes pour les catégories
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
Route::get('/categories/slug/{slug}', [CategoryController::class, 'getBySlug']);

// Routes pour les tags
Route::get('/tags', [TagController::class, 'index']);
Route::post('/tags', [TagController::class, 'store']);
Route::get('/tags/{id}', [TagController::class, 'show']);
Route::put('/tags/{id}', [TagController::class, 'update']);
Route::delete('/tags/{id}', [TagController::class, 'destroy']);
Route::get('/tags/slug/{slug}', [TagController::class, 'getBySlug']);
Route::get('/tags/{id}/courses', [TagController::class, 'coursesByTag']);
