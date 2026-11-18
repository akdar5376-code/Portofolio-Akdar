<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TestimonyController as AdminTestimonyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TestimonyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/skills', [PortfolioController::class, 'skills'])->name('skills');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects.index');
Route::get('/projects/{project}', [PortfolioController::class, 'showProject'])->name('projects.show');
Route::get('/blog', [BlogController::class, 'index'])->name('posts.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('posts.show');
Route::get('/certificates', [PortfolioController::class, 'certificates'])->name('certificates');
Route::get('/experience', [PortfolioController::class, 'experience'])->name('experience');
Route::get('/testimonies', [PortfolioController::class, 'testimonies'])->name('testimonies');
Route::get('/cv', [PortfolioController::class, 'cv'])->name('cv');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');

Route::post('/messages', [MessageController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('messages.store');

Route::post('/testimonies', [TestimonyController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('testimonies.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

    Route::middleware('admin')->group(function (): void {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        Route::get('posts', [AdminPostController::class, 'index'])->name('posts.index');
        Route::post('posts', [AdminPostController::class, 'store'])->name('posts.store');
        Route::put('posts/{post}', [AdminPostController::class, 'update'])->name('posts.update');
        Route::delete('posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');

        Route::get('testimonies', [AdminTestimonyController::class, 'index'])->name('testimonies.index');
        Route::patch('testimonies/{testimony}/visibility', [AdminTestimonyController::class, 'toggleVisibility'])->name('testimonies.toggle-visibility');
        Route::delete('testimonies/{testimony}', [AdminTestimonyController::class, 'destroy'])->name('testimonies.destroy');

        Route::get('certificates', [CertificateController::class, 'index'])->name('certificates.index');
        Route::post('certificates', [CertificateController::class, 'store'])->name('certificates.store');
        Route::put('certificates/{certificate}', [CertificateController::class, 'update'])->name('certificates.update');
        Route::delete('certificates/{certificate}', [CertificateController::class, 'destroy'])->name('certificates.destroy');

        Route::get('content', [ContentController::class, 'index'])->name('content.index');
        Route::get('content/skills', [ContentController::class, 'skills'])->name('content.skills');
        Route::get('content/experiences', [ContentController::class, 'experiences'])->name('content.experiences');
        Route::get('content/educations', [ContentController::class, 'educations'])->name('content.educations');

        Route::post('skills', [SkillController::class, 'store'])->name('skills.store');
        Route::put('skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
        Route::delete('skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');

        Route::post('experiences', [ExperienceController::class, 'store'])->name('experiences.store');
        Route::put('experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.update');
        Route::delete('experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

        Route::post('educations', [EducationController::class, 'store'])->name('educations.store');
        Route::put('educations/{education}', [EducationController::class, 'update'])->name('educations.update');
        Route::delete('educations/{education}', [EducationController::class, 'destroy'])->name('educations.destroy');

        Route::get('messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::patch('messages/{message}/read', [AdminMessageController::class, 'toggleRead'])->name('messages.toggle-read');
        Route::delete('messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');
    });
});
