<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompleteController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskReviewController;
use App\Http\Controllers\TheoryController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::post('/create-account', [AuthController::class, 'createAccount']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/upload', [UploadController::class, 'uploadImage']);
Route::post('/upload-file', [UploadController::class, 'uploadFile']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', [AuthController::class, 'userData']);
    Route::post('/sign-out', [AuthController::class, 'logout']);
    Route::get('/groups', [GroupController::class, 'list']);
    Route::get('/group', [GroupController::class, 'get']);
    Route::post('/create-group', [GroupController::class, 'create']);
    Route::post('/join-group', [GroupController::class, 'join']);
    Route::post('/delete-group', [GroupController::class, 'delete']);
    Route::post('/left-group', [GroupController::class, 'left']);
    Route::get('/theories', [TheoryController::class, 'list']);
    Route::post('/create-theory', [TheoryController::class, 'create']);
    Route::get('/theory', [TheoryController::class, 'get']);
    Route::post('/delete-theory', [TheoryController::class, 'delete']);
    Route::get('/tasks', array(TaskController::class, 'list'));
    Route::post('/create-task', [TaskController::class, 'create']);
    Route::get('/task', array(TaskController::class, 'get'));
    Route::post('/complete-task', [CompleteController::class, 'create']);
    Route::get('/completes', array(CompleteController::class, 'list'));
    Route::get('/complete', array(CompleteController::class, 'get'));
    Route::post('/review-task', [TaskReviewController::class, 'create']);

});
