<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Teacher\ProjectController as TeacherProjectController;
use App\Http\Controllers\Teacher\TaskController as TeacherTaskController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');

    Route::group(['prefix' => 'teacher'], function () {
        Route::resource('projects', TeacherProjectController::class)
            ->except(['show'])
            ->names([
                'index' => 'teacher.projects.index',
                'create' => 'teacher.projects.create',
                'store' => 'teacher.projects.store',
                'edit' => 'teacher.projects.edit',
                'update' => 'teacher.projects.update',
                'destroy' => 'teacher.projects.delete',
            ]);

        Route::resource('tasks', TeacherTaskController::class)
            ->except(['show'])
            ->names([
                'index' => 'teacher.tasks.index',
                'create' => 'teacher.tasks.create',
                'store' => 'teacher.tasks.store',
                'edit' => 'teacher.tasks.edit',
                'update' => 'teacher.tasks.update',
                'destroy' => 'teacher.tasks.delete',
            ]);
    });

});
