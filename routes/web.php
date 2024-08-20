<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
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

Route::middleware('auth')->controller(CategoryController::class)->group(function(){
    Route::get('populate-default-categories','populateDefaultCategories')->name('category_management.populate_defaults');
    Route::get('category-management','listSection')->name('category_management.list');
    Route::post('categories-list','getCategoriesList')->name('category_management.get_list');
    Route::get('activate-category/{category_id}','activateCategory')->name('category_management.activate_category');
    Route::get('deactivate-category/{category_id}','deactivateCategory')->name('category_management.deactivate_category');
    Route::get('delete-category/{category_id}','deleteCategory')->name('category_management.delete_category');
    Route::get('edit-category/{category_id}','editCategorySection')->name('category_management.edit_category');
    Route::post('update-category/{category_id}','updateCategoryDetails')->name('category_management.update_category');
    Route::get('add-category','addCategorySection')->name('category_management.add_category');
    Route::post('create-category','createCategoryDetails')->name('category_management.create_category');
});
 
