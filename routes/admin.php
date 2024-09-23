<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\OrganizationsController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Organization;
use Illuminate\Support\Facades\Route;

Route::get('admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login_post'])->name('admin.login.post');

Route::middleware(['is_super_admin','auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',[IndexController::class,'index'])->name('index');

    // Plan route 
    Route::resource('plans', PlanController::class);

    // Organization routes
    Route::resource('organizations', OrganizationsController::class);

    // User route
    Route::get('users/{id}',[UserController::class,'index'])->name('users.index');
    Route::get('users/create/{id}',[UserController::class,'create'])->name('users.create');
    Route::post('users/store',[UserController::class,'store'])->name('users.store');
    Route::get('user/{id}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::post('users/update/{id}',[UserController::class,'update'])->name('users.update');
    Route::get('users/status/{id}',[UserController::class,'change_status'])->name('users.status');

    // Role routes
    Route::resource('roles', RoleController::class);
    Route::any('roles/permissions/{id}',[RoleController::class,'permissions'])->name('roles.permissions');

    // Section routes
    Route::resource('sections', SectionController::class);
    
    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {

        // General Settings
        Route::any('/general',[SettingsController::class,'general'])->name('general');

    });
});
