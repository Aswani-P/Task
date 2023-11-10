<?php

use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\Task\TaskDeleteController;
use App\Http\Controllers\Task\TaskPdfController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('tasks', TaskController::class);
Route::post('delete', [TaskDeleteController::class, 'delete_data'])->name('delete_data');
Route::post('delete_data', [TaskDeleteController::class, 'delete_data'])->name('delete_data');
Route::get('view/{id}',[TaskPdfController::class,'view'])->name('view');
Route::get('pdf/{id}',[TaskPdfController::class,'taskPdf'])->name('pdf');
Route::get('export',[TaskPdfController::class,'taskExport'])->name('export');
Route::post('import',[TaskPdfController::class,'taskImport'])->name('import');
