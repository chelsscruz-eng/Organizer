<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// USERS
Route::get('/users/index', [UserController::class, 'index'])->middleware('auth')->name('users.index');
Route::get('/users/add', [UserController::class, 'add'])->middleware('auth')->name('users.add');
Route::post('/users/insert', [UserController::class, 'insert'])->middleware('auth')->name('users.insert');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->middleware('auth')->name('users.edit');
Route::post('/users/update', [UserController::class, 'update'])->middleware('auth')->name('users.update');
Route::post('/users/delete/{id}', [UserController::class, 'delete'])->middleware('auth')->name('users.delete');


// PROJECTS
Route::get('/projects/index', [ProjectController::class, 'index'])->middleware('auth')->name('projects.index');
Route::get('/projects/add', [ProjectController::class, 'add'])->middleware('auth')->name('projects.add');
Route::post('/projects/insert', [ProjectController::class, 'insert'])->middleware('auth')->name('projects.insert');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->middleware('auth')->name('projects.show');
Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->middleware('auth')->name('projects.edit');
Route::post('/projects/update', [ProjectController::class, 'update'])->middleware('auth')->name('projects.update');
Route::post('/projects/delete/{id}', [ProjectController::class, 'delete'])->middleware('auth')->name('projects.delete');

//CATEGORIES    
Route::get('/categories/index', [CategoryController::class, 'index'])->middleware('auth')->name('categories.index');
Route::get('/categories/add', [CategoryController::class, 'add'])->middleware('auth')->name('categories.add');
Route::post('/categories/insert', [CategoryController::class, 'insert'])->middleware('auth')->name('categories.insert');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->middleware('auth')->name('categories.edit');
Route::post('/categories/update', [CategoryController::class, 'update'])->middleware('auth')->name('categories.update');
Route::post('/categories/delete/{id}', [CategoryController::class, 'delete'])->middleware('auth')->name('categories.delete');

// TAREAS
Route::get('/projects/{projectId}/tasks/add', [TaskController::class, 'add'])->middleware('auth')->name('tasks.add');
Route::post('/tasks/insert', [TaskController::class, 'insert'])->middleware('auth')->name('tasks.insert');
Route::post('/tasks/{id}/close', [TaskController::class, 'close'])->middleware('auth')->name('tasks.close');

// MIEMBROS 
Route::get('/projects/{id}/members', [ProjectController::class, 'members'])->name('projects.members');
Route::post('/projects/{id}/members', [ProjectController::class, 'addMember'])->name('projects.addMember');
Route::delete('/projects/{project}/members/{user}', [ProjectController::class, 'removeMember'])->name('projects.removeMember');