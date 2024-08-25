<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
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
    Route::get('account/my-profile','myProfileSection')->name('profile.view');
    Route::get('account/edit-profile','editProfileSection')->name('profile.edit');
    Route::post('account/update-profile-personal-info','updateProfilePersonalInfo')->name('profile.update_personal_info');
    Route::post('account/update-profile-password','updateProfilePasswordDetails')->name('profile.update_password');
    Route::post('account/update-contact','updateProfileContactDetails')->name('profile.update_contact');
});

Route::middleware('auth')->controller(CategoryController::class)->group(function(){
    Route::get('category-management/populate-default-categories','populateDefaultCategories')->name('category_management.populate_defaults');
    Route::get('category-management','listSection')->name('category_management.list');
    Route::post('category-management/categories-list','getCategoriesList')->name('category_management.get_list');
    Route::get('category-management/activate-category/{category_id}','activateCategory')->name('category_management.activate_category');
    Route::get('category-management/deactivate-category/{category_id}','deactivateCategory')->name('category_management.deactivate_category');
    Route::get('category-management/delete-category/{category_id}','deleteCategory')->name('category_management.delete_category');
    Route::get('category-management/edit-category/{category_id}','editCategorySection')->name('category_management.edit_category');
    Route::post('category-management/update-category/{category_id}','updateCategoryDetails')->name('category_management.update_category');
    Route::get('category-management/add-category','addCategorySection')->name('category_management.add_category');
    Route::post('category-management/create-category','createCategoryDetails')->name('category_management.create_category');
});

Route::middleware('auth')->controller(InvestmentController::class)->group(function(){
    Route::get('investments','listSection')->name('investments.list');
    Route::get('investments/add-investment','addInvestmentSection')->name('investments.add_investments');
    Route::post('investments/create-investment','createInvestmentDetails')->name('investments.create_investment');
    Route::post('investments/categories-list','getInvestmentsListForUser')->name('investments.get_list_for_user');
    Route::get('investments/activate-investment/{investment_id}','activateInvestment')->name('investments.activate_investment');
    Route::get('investments/deactivate-investment/{investment_id}','deactivateInvestment')->name('investments.deactivate_investment');
    Route::get('investments/delete-investment/{investment_id}','deleteInvestment')->name('investments.delete_investment');
    Route::get('investments/edit-investment/{investment_id}','editInvestmentSection')->name('investments.edit_investment');
    Route::post('investments/update-investment/{investment_id}','updateInvestmentDetails')->name('investments.update_investment');
});
 
