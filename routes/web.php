<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\Registercontroller;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\Task\TaskDeleteController;
use App\Http\Controllers\Task\TaskPdfController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[Registercontroller::class,'register']);
Route::post('store-register',[Registercontroller::class,'store'])->name('store');
Route::get('login',[Registercontroller::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'userLogin'])->name('login');
Route::get('admin',[AuthController::class,'view'])->name('admin');

Route::resource('tasks', TaskController::class);
Route::get('list', [TaskController::class, 'list'])->name('list');
Route::delete('list', [TaskController::class, 'delete'])->name('delete');
// Route::post('delete', [TaskDeleteController::class, 'delete_data'])->name('delete_data');
// Route::delete('delete_data/{id}', [TaskDeleteController::class, 'delete_data'])->name('delete_data');
Route::get('view/{id}',[TaskPdfController::class,'view'])->name('view');
Route::get('pdf/{id}',[TaskPdfController::class,'taskPdf'])->name('pdf');
Route::get('export',[TaskPdfController::class,'taskExport'])->name('export');
Route::post('import',[TaskPdfController::class,'taskImport'])->name('import');
Route::get('role',[TaskPdfController::class,'show'])->name('show_role');
Route::post('store-role',[TaskPdfController::class,'store'])->name('store');

Route::get('show-role',[RoleController::class,'view'])->name('view');
Route::get('manage-role',[RoleController::class,'list'])->name('manage_role');
Route::get('edit-role/{id}',[RoleController::class,'edit_role'])->name('edit_role');
Route::post('asign-role',[RoleController::class,'store_role'])->name('store_role');
