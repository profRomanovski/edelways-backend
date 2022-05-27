<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
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

});
