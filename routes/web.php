<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\pagesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/upload');


Route::get('/upload', [pagesController::class, 'returnForm']);
Route::post('/upload', [pagesController::class, 'upload']);
// Route::post('/upload', [pagesController::class, 'upload']);
Route::post('/remove_file', [pagesController::class, 'removeFile'])->name('remove_file');

Route::get('/test_upload', [pagesController::class, 'getForm']);
Route::post('/test_upload', [pagesController::class, 'testUpload']);

// Route::get('/demo', [pagesController::class, 'demo_folder_name']);
Route::get('/demo_zip', [pagesController::class, 'demo_zip']);
Route::get('/make_zip', [pagesController::class, 'make_zip']);
