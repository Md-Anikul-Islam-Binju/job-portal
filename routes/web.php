<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\company\CategoryController;
use App\Http\Controllers\company\CompanyDashboardController;
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

Route::get('/', function () {
    return view('auth/login');
});

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


        //Site Setting
        Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('admin.site.setting');
        Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('admin.site.settings.createOrUpdate');

        //Site About
        Route::get('/about', [AboutController::class, 'index'])->name('admin.about');
        Route::post('/about-update/{id?}', [AboutController::class, 'createOrUpdateAbout'])->name('admin.about.createOrUpdate');
    });


    Route::middleware(['company'])->prefix('company')->group(function () {
        //dashboard
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');

        //Category Section
        Route::get('/category-section', [CategoryController::class, 'index'])->name('company.category');
        Route::post('/category-store', [CategoryController::class, 'store'])->name('company.category.store');
        Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('company.category.update');
        Route::get('/category-delete/{id}', [CategoryController::class, 'destroy'])->name('company.category.destroy');
    });
});


require __DIR__.'/auth.php';
