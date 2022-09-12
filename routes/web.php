<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::get('/messages', [App\Http\Controllers\HomeController::class, 'messages'])->name('messages');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('adminDashboard');
Route::get('/adminCategories', [App\Http\Controllers\HomeController::class, 'adminCategory'])->name('adminCategory');
Route::get('/adminAddCategory', [App\Http\Controllers\HomeController::class, 'adminAddCategory'])->name('adminAddCategory');
Route::post('/adminAddCategory', [App\Http\Controllers\HomeController::class, 'adminAddCategoryPost'])->name('adminAddCategoryPost');
Route::get('/updateCategoryStatus/{action}/{category_id}', [App\Http\Controllers\HomeController::class, 'updateCategoryStatus'])->name('updateCategoryStatus');
Route::get('/adminDeleteCategory/{category_id}', [App\Http\Controllers\HomeController::class, 'adminDeleteCategory'])->name('adminDeleteCategory');
Route::get('/adminTask', [App\Http\Controllers\HomeController::class, 'adminTask'])->name('adminTask');

Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'userDashboard'])->name('userDashboard');
Route::get('/sendMessage', [App\Http\Controllers\UserController::class, 'userSendMessage'])->name('userSendMessage');
Route::post('/sendMessage', [App\Http\Controllers\UserController::class, 'sendMessage'])->name('sendMessage');
Route::get('/myMessages', [App\Http\Controllers\UserController::class, 'userMessages'])->name('userMessages');

//Tasks
Route::get('/tasks', [App\Http\Controllers\UserController::class, 'userTask'])->name('userTask');
Route::get('/addTask', [App\Http\Controllers\UserController::class, 'userAddTask'])->name('userAddTask');
Route::post('/addTask', [App\Http\Controllers\UserController::class, 'userAddTaskPost'])->name('userAddTaskPost');
Route::get('/updateTaskStatus/{action}/{task_id}', [App\Http\Controllers\UserController::class, 'updateTaskStatus'])->name('updateTaskStatus');
Route::get('/deleteTask/{task_id}', [App\Http\Controllers\UserController::class, 'deleteTask'])->name('deleteTask');

Route::post('/registerUser', [App\Http\Controllers\UserController::class, 'registerUserPost'])->name('registerUserPost');
Route::post('/loginUser', [App\Http\Controllers\UserController::class, 'loginUserPost'])->name('loginUserPost');
Route::get('/logoutUser', [App\Http\Controllers\UserController::class, 'logoutUser'])->name('logoutUser');

Route::get('/updateUserStatus/{action}/{user_id}', [App\Http\Controllers\HomeController::class, 'updateUserStatus'])->name('updateUserStatus');
