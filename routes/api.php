<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::GET('users',[UserController::class, 'index']);
Route::GET('users/{id}',[UserController::class, 'edit']);
Route::DELETE('users/{id}',[UserController::class, 'delete']);
Route::POST('/store/users',[UserController::class,'store']);
