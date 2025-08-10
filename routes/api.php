<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/users/count', [UserController::class, 'countUsers']);
Route::apiResource('roles', RoleController::class);
Route::post('/users/{userId}/roles', [UserRoleController::class, 'assignRoles']);
Route::get('/users/{userId}/roles', [UserRoleController::class, 'getUserRoles']);
Route::delete('/users/{userId}/roles/{roleId}', [UserRoleController::class, 'detachRole']);
Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/{id}', [PostsController::class, 'show']);
Route::post('/posts', [PostsController::class, 'store']);
Route::put('/posts/{id}', [PostsController::class, 'update']);
Route::delete('/posts/{id}', [PostsController::class, 'destroy']);
Route::get('/users/{userId}/posts', [PostsController::class, 'getPostsByUser']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/posts', [PostsController::class, 'store']);
    Route::put('/posts/{id}', [PostsController::class, 'update']);
    Route::delete('/posts/{id}', [PostsController::class, 'destroy']);

    Route::post('/users/{userId}/roles', [UserRoleController::class, 'assignRoles']);
    Route::delete('/users/{userId}/roles/{roleId}', [UserRoleController::class, 'detachRole']);
});
