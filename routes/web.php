<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingsPrivacyController;
use App\Http\Controllers\VaccineFormController;

Route::get('/', [VaccineFormController::class, 'index']);
Route::post('/provinces', [VaccineFormController::class, 'getProvinces'])->name('get.provinces');
Route::post('/cities', [VaccineFormController::class, 'getCities'])->name('get.cities');
Route::post('/baranggays', [VaccineFormController::class, 'getBaranggays'])->name('get.baranggays');

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
    });
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users');
        Route::post('/table', [UsersController::class, 'usersTable'])->name('users.table');
        Route::post('/update', [UsersController::class, 'update'])->name('users.update');
        Route::post('/store', [UsersController::class, 'store'])->name('users.store');
        Route::post('/cp', [UsersController::class, 'changePassword'])->name('users.cp');
    });
    Route::prefix('roles')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('roles');
        Route::post('/store', [RolesController::class, 'store'])->name('roles.store');
        Route::post('/update', [RolesController::class, 'update'])->name('roles.update');
        Route::post('/destroy', [RolesController::class, 'destroy'])->name('roles.delete');
        Route::post('/table', [RolesController::class, 'table'])->name('roles.table');
    });
    Route::prefix('settings-privacy')->group(function () {
        Route::get('/', [SettingsPrivacyController::class, 'index'])->name('settings-privacy');
        Route::post('/upload-photo', [SettingsPrivacyController::class, 'uploadPhoto'])->name('settings-privacy.up');
    });
});
