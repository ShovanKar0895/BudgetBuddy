<?php

use App\Http\Controllers\AccountController;
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

Route::middleware('auth')->controller(AccountController::class)->group(function(){
    Route::get('my-profile','myProfileSection')->name('profile.view');
    Route::get('edit-profile','editProfileSection')->name('profile.edit');
    Route::post('update-profile-personal-info','updateProfilePersonalInfo')->name('profile.update_personal_info');
    Route::post('update-profile-password','updateProfilePasswordDetails')->name('profile.update_password');
    Route::post('update-contact','updateProfileContactDetails')->name('profile.update_contact');
});
 
