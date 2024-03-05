<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');
Route::get('/jobs/detail/{id}', [JobsController::class, 'detail'])->name('jobDetail');
Route::post('/apply-job', [JobsController::class, 'applyJob'])->name('applyJob');
Route::post('/save-job/{id}', [JobsController::class, 'saveJob'])->name('savedJob');





Route::group(['account'], function(){
    // Guest Route
    Route::group(['middleware' =>'guest'], function(){
        Route::get('/account/register', [AccountController::class, 'registration'])->name('account.registration');
        Route::post('/account/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/account/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/account/authenticate', [AccountController::class, 'auhtenticate'])->name('account.auhtenticate');
    });

    // Authenticated Routes 
    Route::group(['middleware' =>'auth'], function(){
        Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::put('/account/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::get('/account/logout', [AccountController::class, 'logOut'])->name('account.logout');
        Route::post('/update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');

        Route::get('/category', [AccountController::class, 'category'])->name('account.category');
        Route::get('/create-category', [AccountController::class, 'createCategory'])->name('account.createCategory');
        Route::post('/save-category', [AccountController::class, 'saveCategory'])->name('account.saveCategory');

        Route::get('/jobType', [AccountController::class, 'jobType'])->name('account.jobType');
        Route::get('/create-jobType', [AccountController::class, 'createjobType'])->name('account.createjobType');
        Route::post('/save-jobType', [AccountController::class, 'savejobType'])->name('account.savejobType');
        


        Route::get('/create-job', [AccountController::class, 'createJob'])->name('account.createJob');
        Route::post('/save-job', [AccountController::class, 'saveJob'])->name('account.saveJob');
        Route::get('/my-jobs', [AccountController::class, 'myJobs'])->name('account.myJobs');
        Route::get('/my-jobs/edit/{id}', [AccountController::class, 'editJob'])->name('account.editJob');
        Route::post('/update-job/{id}', [AccountController::class, 'updateJob'])->name('account.updateJob');
        Route::delete('/delete-job', [AccountController::class, 'deleteJob'])->name('account.deleteJob');
        Route::get('/my-job-application', [AccountController::class, 'myJobApplication'])->name('account.myJobApplication');
        Route::delete('/remove-job', [AccountController::class, 'removeJob'])->name('account.removeJob');

    });
});