<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TermsAndConditionController;
use App\Http\Controllers\company\CompanyDashboardController;
use App\Http\Controllers\user\FrontendController;
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



//Route::get('/', function () {
//    return view('auth/login');
//});

Route::get('/', [FrontendController::class, 'frontend'])->name('home');

//Admin
Route::middleware('auth')->group(callback: function () {

    Route::middleware(['admin'])->prefix('admin')->group(function () {

        //dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        //Slider Section
        Route::get('/slider-section', [SliderController::class, 'index'])->name('admin.slider.section');
        Route::post('/slider-store', [SliderController::class, 'store'])->name('admin.slider.store');
        Route::put('/slider-update/{id}', [SliderController::class, 'update'])->name('admin.slider.update');
        Route::get('/slider-delete/{id}', [SliderController::class, 'destroy'])->name('admin.slider.destroy');

        //Service Section
        Route::get('/service-section', [ServiceController::class, 'index'])->name('admin.service.section');
        Route::post('/service-store', [ServiceController::class, 'store'])->name('admin.service.store');
        Route::put('/service-update/{id}', [ServiceController::class, 'update'])->name('admin.service.update');
        Route::get('/service-delete/{id}', [ServiceController::class, 'destroy'])->name('admin.service.destroy');

        //Category Section
        Route::get('/category-section', [CategoryController::class, 'index'])->name('admin.category');
        Route::post('/category-store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/category-delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

        //Location Section
        Route::get('/location-section', [LocationController::class, 'index'])->name('admin.location');
        Route::post('/location-store', [LocationController::class, 'store'])->name('admin.location.store');
        Route::put('/location-update/{id}', [LocationController::class, 'update'])->name('admin.location.update');
        Route::get('/location-delete/{id}', [LocationController::class, 'destroy'])->name('admin.location.destroy');



        //Site Setting
        Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('admin.site.setting');
        Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('admin.site.settings.createOrUpdate');

        //Site About
        Route::get('/about', [AboutController::class, 'index'])->name('admin.about');
        Route::post('/about-update/{id?}', [AboutController::class, 'createOrUpdateAbout'])->name('admin.about.createOrUpdate');

        //Site Terms and Condition
        Route::get('/terms-and-condition', [TermsAndConditionController::class, 'index'])->name('admin.terms.condition');
        Route::post('/terms-and-condition-update/{id?}', [TermsAndConditionController::class, 'createOrUpdateTermsCondition'])->name('admin.terms.condition.createOrUpdate');
    });


    Route::middleware(['company'])->prefix('company')->group(function () {
        //dashboard
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');


    });
});


require __DIR__.'/auth.php';
