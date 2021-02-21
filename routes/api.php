<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\apiResource;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
    //Route::apiResource('messages', MessageController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('comments', CommentController::class)->except(['index', 'show']);
    Route::post('thread', [MessageController::class, 'store']);
    Route::get('thread', [MessageController::class, 'index']);
    Route::post('thread/messages', [MessageController::class, 'message']);
    Route::get('thread/{id}/messages', [MessageController::class, 'show']);

});





Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);




