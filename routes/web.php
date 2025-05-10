<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::view('/', 'welcome');
Route::view('/upload_file', 'upload_file');

Route::post('/upload/local', [UploadController::class, 'uploadToLocal'])->name('upload.local');
Route::get('/file/local/{filename}', [UploadController::class, 'getFromLocal'])->name('file.local');

Route::post('/upload/minio', [UploadController::class, 'uploadToMinio'])->name('upload.minio');
Route::get('/file/minio/{filename}', [UploadController::class, 'getFromMinio'])->name('file.minio');
