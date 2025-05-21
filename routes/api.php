<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes for Blog Posts
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

// API Routes for user Registration
Route::post('/register', [AuthController::class, 'register']);


// API Routes for Tasks
Route::post('/tasks', [TaskController::class, 'store']);
Route::patch('/tasks/{id}', [TaskController::class, 'update']);
Route::get('/tasks/pending', [TaskController::class, 'pending']);
Route::get('/tasks', [TaskController::class, 'index']);
