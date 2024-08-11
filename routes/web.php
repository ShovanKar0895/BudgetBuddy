<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::controller(LandingController::class)->group(function(){
    Route::get('/login','userLoginSection')->name('landing.user_login_section');
    Route::post('process-login','processLogin')->name('landing.process_login');
});

Route::middleware('auth')->controller(DashboardController::class)->group(function(){
    Route::get('dashboard','dashboardSection')->name('dashboard.index');
    Route::get('logout','logout')->name('dashboard.logout');
 });
 
