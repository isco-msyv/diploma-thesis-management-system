<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Student\ProjectController;
use App\Http\Controllers\Student\TaskController;
use App\Http\Controllers\Student\TopicController;
use App\Http\Controllers\Teacher\ProjectController as TeacherProjectController;
use App\Http\Controllers\Teacher\ProjectRequestController as TeacherProjectRequestController;
use App\Http\Controllers\Teacher\TaskController as TeacherTaskController;
use App\Http\Controllers\Teacher\TopicController as TeacherTopicController;
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
        Route::resource('topics', TeacherTopicController::class)
            ->except(['show'])
            ->names([
                'index' => 'teacher.topics.index',
                'create' => 'teacher.topics.create',
                'store' => 'teacher.topics.store',
                'edit' => 'teacher.topics.edit',
                'update' => 'teacher.topics.update',
                'destroy' => 'teacher.topics.delete',
            ]);

        Route::resource('projects', TeacherProjectController::class)
            ->except(['show', 'create', 'store'])
            ->names([
                'index' => 'teacher.projects.index',
                'edit' => 'teacher.projects.edit',
                'update' => 'teacher.projects.update',
                'destroy' => 'teacher.projects.delete',
            ]);

        Route::resource('tasks', TeacherTaskController::class)
            ->except(['index', 'show', 'create', 'edit', 'update'])
            ->names([
                'store' => 'teacher.tasks.store',
                'destroy' => 'teacher.tasks.delete',
            ]);

        Route::get('/project-requests', [TeacherProjectRequestController::class, 'index'])->name('teacher.projectRequests.index');
        Route::put('/project-requests/{projectRequest}', [TeacherProjectRequestController::class, 'update'])->name('teacher.projectRequests.update');
    });

    Route::group(['prefix' => 'student', 'middleware' => ['checkUserTypeStudent']], function () {
        Route::group(['middleware' => ['checkStudentHasNoProjectOrProjectRequest']], function () {
            Route::get('topics', [TopicController::class, 'index'])->name('student.topics.index');
            Route::get('topics/{topic}', [TopicController::class, 'show'])->name('student.topics.show');
            Route::post('topics/{topic}', [TopicController::class, 'apply'])->name('student.topics.apply');
        });

        Route::group(['middleware' => ['checkStudentHasProjectOrProjectRequest']], function () {
            Route::get('project', [ProjectController::class, 'show'])->name('student.project.show');
            Route::put('project', [ProjectController::class, 'submit'])->name('student.project.submit');
            Route::put('tasks/{task}', [TaskController::class, 'complete'])->name('student.task.complete');
        });
    });
});
