<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\JobController;
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
Route::apiResource('roles', RoleController::class);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/users/count', [UserController::class, 'countUsers']);
    Route::get('/users/{userId}/roles', [UserRoleController::class, 'getUserRoles']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/users/{userId}/roles', [UserRoleController::class, 'assignRoles']);
    Route::delete('/users/{userId}/roles/{roleId}', [UserRoleController::class, 'detachRole']);

    Route::get('/posts', [PostsController::class, 'index']);
    Route::get('/posts/count', [PostsController::class, 'countPosts']);
    Route::get('/posts/{id}', [PostsController::class, 'show']);
    Route::post('/posts', [PostsController::class, 'store']);
    Route::put('/posts/{id}', [PostsController::class, 'update']);
    Route::delete('/posts/{id}', [PostsController::class, 'destroy']);


    Route::get('/comments', [CommentController::class, 'index']);
    Route::get('/comments/count', [CommentController::class, 'countComments']);
    Route::get('/comments/{id}', [CommentController::class, 'show']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);


    Route::get('/clients', [ClientController::class, 'index']);
    Route::get('/clients/count', [ClientController::class, 'countClients']);
    Route::get('/clients/{id}', [ClientController::class, 'show']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::put('/clients/{id}', [ClientController::class, 'update']);
    Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

    Route::get('/jobs', [JobController::class, 'index']);
    Route::get('/jobs/count', [JobController::class, 'countJobs']);
    Route::get('/clients/{clientId}/jobs', [JobController::class, 'getJobsByClient']);
    Route::get('/jobs/{id}', [JobController::class, 'show']);
    Route::post('/jobs', [JobController::class, 'store']);
    Route::put('/jobs/{id}', [JobController::class, 'update']);
    Route::delete('/jobs/{id}', [JobController::class, 'destroy']);

    Route::get('/friends', [FriendshipController::class, 'listFriends']);
    Route::get('/friends/count', [FriendshipController::class, 'countFriends']);
    Route::get('/friends/countRequests', [FriendshipController::class, 'countPendingRequests']);
    Route::get('/friends/available', [UserController::class, 'availableFriends']);
    Route::get('/friends/requests', [FriendshipController::class, 'pendingRequests']);;
    Route::post('/friends/{sender_id}/sendRequest/{receiver_id}', [FriendshipController::class, 'sendRequest']);
    Route::post('/friends/acceptRequest/{sender_id}', [FriendshipController::class, 'acceptRequest']);
    Route::post('/friends/denyRequest/{sender_id}', [FriendshipController::class, 'denyRequest']);
});
