<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Files\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route Auth 

Route::post('auth/login', [AuthController::class,'login']);
Route::post('auth/logout', [AuthController::class,'logOut'])->middleware(['auth:sanctum']);


Route::middleware(['auth:sanctum'])->group(function () {
    // Route file
    Route::post('upload/files',[FileController::class,'uploadFile']);

});
