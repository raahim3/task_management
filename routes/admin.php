<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\OrganizationsController;
use App\Http\Controllers\Admin\PlanController;
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
});
