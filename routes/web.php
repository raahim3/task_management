<?php

use App\Http\Controllers\CronJobsController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\PlanController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\TaskController;
use App\Http\Controllers\Dashboard\TeamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Payments\StripeController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[SiteController::class,'index'])->name('home');

Auth::routes();
Route::middleware(['is_admin','check_subscription'])->group(function () {
Route::post('/upload-image', [HomeController::class, 'upload'])->name('image.upload');
Route::post('/delete-image', [HomeController::class, 'delete'])->name('image.delete');



Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('project',ProjectController::class);
Route::post('project/change/status',[ProjectController::class,'change_status'])->name('project.change.status');
Route::post('get/assignees',[ProjectController::class,'get_assignees'])->name('get.assignees');
Route::post('search/assignees',[ProjectController::class,'search_assignees'])->name('search.assignees');
Route::post('project/add/assignees',[ProjectController::class,'add_assignees'])->name('project.add.assignees');

Route::resource('task',TaskController::class);
Route::post('task/add/assignees',[TaskController::class,'add_assignees'])->name('task.add.assignees');
Route::post('task/change/priority',[TaskController::class,'change_priority'])->name('task.change.priority');
Route::post('task/change/status',[TaskController::class,'change_status'])->name('task.change.status');
Route::post('task/file/upload/{id}',[TaskController::class,'uploadFile'])->name('task.file.upload');
Route::post('task/file/delete/{id}',[TaskController::class,'deleteFile'])->name('task.file.delete');
Route::post('task/update/description/{id}',[TaskController::class,'updateDescription'])->name('task.update.description');

Route::resource('team',TeamController::class);
Route::get('team/status/{id}',[TeamController::class,'change_status'])->name('team.status');

Route::resource('comment',CommentController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('plan',[PlanController::class,'index'])->name('plan.index');
    Route::get('plan/checkout/{id}',[PlanController::class,'checkout'])->name('plan.checkout');
    Route::post('plan/checkout/{id}',[PlanController::class,'checkout_process'])->name('plan.checkout.process');
    Route::get('stripe/checkout/success',[StripeController::class,'success'])->name('stripe.checkout.success');
    Route::get('stripe/checkout/cancel',[StripeController::class,'cancel'])->name('stripe.checkout.cancel'); 
    Route::get('my/subscriptions',[PlanController::class,'my_plans'])->name('plan.my_plans');
    Route::post('subscription/change',[PlanController::class,'change_subscription'])->name('change.subscription');

});


// Cron Jobs
Route::get('/analyse_subscriptions',[CronJobsController::class,'analyse_subscriptions'])->name('analyse_subscriptions');