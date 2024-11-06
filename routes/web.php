<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TermsAndConditionController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\company\CompanyDashboardController;
use App\Http\Controllers\company\JobController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JobBoardController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\user\EducationController;
use App\Http\Controllers\user\ExperiencesController;
use App\Http\Controllers\user\SkillController;
use App\Http\Controllers\user\UserController;
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





Route::get('/', [FrontendController::class, 'frontend'])->name('home');
Route::get('/job-board', [JobBoardController::class, 'jobBoard'])->name('job.board');
Route::get('/job-details/{id}', [JobBoardController::class, 'jobDetails'])->name('job.details');
Route::get('/jobs/apply/{job}', [UserController::class, 'applyJob'])->name('jobs.apply');

//contact
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/about-us', [AboutUsController::class, 'about'])->name('about.us');
Route::get('/terms-condition', [TermsConditionController::class, 'termsCondition'])->name('terms.condition');

//free message
Route::post('/message', [ContactController::class, 'store'])->name('message.store');

//blog
Route::get('/blog', [BlogPageController::class, 'blog'])->name('blog');

//User Account
Route::get('/user-registration-start', [UserController::class, 'showRegistrationForm'])->name('user.registration.start');
Route::post('/user-registration', [UserController::class, 'storeRegistration'])->name('user.registration');
Route::get('/user-verify', [UserController::class, 'showVerificationForm'])->name('user.verification');
Route::post('/user-verify-account', [UserController::class, 'verify'])->name('user.verify');

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

        //Company Section
        Route::get('/company-section', [CompanyController::class, 'index'])->name('admin.company');
        Route::post('/company-store', [CompanyController::class, 'store'])->name('admin.company.store');
        Route::put('/company-update/{id}', [CompanyController::class, 'update'])->name('admin.company.update');
        Route::get('/company-delete/{id}', [CompanyController::class, 'destroy'])->name('admin.company.destroy');

        //Blog Section
        Route::get('/blog-section', [BlogController::class, 'index'])->name('admin.blog');
        Route::post('/blog-store', [BlogController::class, 'store'])->name('admin.blog.store');
        Route::put('/blog-update/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
        Route::get('/blog-delete/{id}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');

        //review Section
        Route::get('/review-section', [ReviewController::class, 'index'])->name('admin.review');
        Route::post('/review-store', [ReviewController::class, 'store'])->name('admin.review.store');
        Route::put('/review-update/{id}', [ReviewController::class, 'update'])->name('admin.review.update');
        Route::get('/review-delete/{id}', [ReviewController::class, 'destroy'])->name('admin.review.destroy');




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

        //Job Section
        Route::get('/job-section', [JobController::class, 'index'])->name('company.job.section');
        Route::post('/job-store', [JobController::class, 'store'])->name('company.job.store');
        Route::put('/job-update/{id}', [JobController::class, 'update'])->name('company.job.update');
        Route::get('/job-delete/{id}', [JobController::class, 'destroy'])->name('company.job.destroy');


        //candidate
        Route::get('/job-candidate', [JobController::class, 'candidate'])->name('company.job.candidate');
        Route::get('/job-candidate-delete/{id}', [JobController::class, 'candidateDestroy'])->name('company.job.candidate.destroy');
        Route::get('/job-candidate-details/{id}', [JobController::class, 'candidateDetails'])->name('company.job.candidate.details');
    });


    Route::middleware(['user'])->prefix('user')->group(function () {
        //dashboard
        Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

        //Site Setting
        Route::get('/account-setting', [UserController::class, 'account'])->name('user.account.setting');
        Route::post('/account-settings-store-update/{id?}', [UserController::class, 'createOrUpdateAccount'])->name('user.account.settings.createOrUpdate');


        //Education Section
        Route::get('/education-section', [EducationController::class, 'index'])->name('user.education.section');
        Route::post('/education-store', [EducationController::class, 'store'])->name('user.education.store');
        Route::put('/education-update/{id}', [EducationController::class, 'update'])->name('user.education.update');
        Route::get('/education-delete/{id}', [EducationController::class, 'destroy'])->name('user.education.destroy');

        //Experiences Section
        Route::get('/experiences-section', [ExperiencesController::class, 'index'])->name('user.experiences.section');
        Route::post('/experiences-store', [ExperiencesController::class, 'store'])->name('user.experiences.store');
        Route::put('/experiences-update/{id}', [ExperiencesController::class, 'update'])->name('user.experiences.update');
        Route::get('/experiences-delete/{id}', [ExperiencesController::class, 'destroy'])->name('user.experiences.destroy');

        //Skill Section
        Route::get('/skill-section', [SkillController::class, 'index'])->name('user.skill.section');
        Route::post('/skill-store', [SkillController::class, 'store'])->name('user.skill.store');
        Route::put('/skill-update/{id}', [SkillController::class, 'update'])->name('user.skill.update');
        Route::get('/skill-delete/{id}', [SkillController::class, 'destroy'])->name('user.skill.destroy');


        Route::get('/applied-job-list', [UserController::class, 'applyJobList'])->name('user.job.apply');






    });
});


require __DIR__.'/auth.php';
