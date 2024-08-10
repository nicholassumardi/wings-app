<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Select2Controller;
use App\Http\Controllers\TaskManagementController;
use App\Http\Controllers\UserController;
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


Route::prefix('/')->group(function () {
    Route::match(['get', 'post'], '/', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::match(['get', 'post'], 'register', [AuthController::class, 'register']);
});

Route::prefix('admin')->middleware('auth.login')->group(function () {
    // Route::middleware('auth.role:1|2|3|4|5|6')->group(function () {});
    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('task_management')->group(function () {
        Route::get('/', [TaskManagementController::class, 'index']);
        Route::get('detail', [TaskManagementController::class, 'detail']);
        Route::get('datatable', [TaskManagementController::class, 'datatable']);
        Route::match(['get', 'post'], 'create', [TaskManagementController::class, 'create']);
        Route::match(['get', 'post'],'update', [TaskManagementController::class, 'update']);
        Route::get('show', [TaskManagementController::class, 'show']);
        Route::delete('delete', [TaskManagementController::class, 'delete']);
    });
    Route::prefix('user_setting')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('datatable', [UserController::class, 'datatableUser']);
        Route::post('create', [UserController::class, 'createUser']);
        Route::post('update', [UserController::class, 'updateUser']);
        Route::get('show', [UserController::class, 'getDataUser']);
        Route::delete('delete/{id}', [UserController::class, 'deleteUser']);
    });

    Route::prefix('role_setting')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('datatable', [UserController::class, 'datatableRole']);
        Route::post('create', [UserController::class, 'createRole']);
        Route::post('update', [UserController::class, 'updateRole']);
        Route::get('show', [UserController::class, 'getDataRole']);
        Route::delete('delete', [UserController::class, 'deleteRole']);
    });

    Route::prefix('select2')->group(function () {
        Route::get('user', [Select2Controller::class, 'user']);
        Route::get('role', [Select2Controller::class, 'role']);
    });
});
