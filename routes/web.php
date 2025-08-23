<?php

use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\EditGroupController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\Client\ResearchController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TopicController;

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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('handleLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('handleLogout');

Route::prefix('admin')->middleware(['auth'])->group(function (): void {
    Route::get('/', fn() => redirect()->route('admin.campaigns.index'));
    Route::get('/dashboard', fn() => view('pages.dashboard'))->name('admin.dashboard');
    Route::prefix('campaigns')->group(function (): void {
        Route::get('/', [CampaignController::class, 'index'])->name('admin.campaigns.index');
        Route::get('/create', [CampaignController::class, 'create'])->name('admin.campaigns.create');
        Route::get('/download-template-student', [CampaignController::class, 'downloadTemplateStudent'])->name('admin.campaigns.downloadTemplateStudent');
        Route::get('/download-template-student-group', [CampaignController::class, 'downloadTemplateStudentGroup'])->name('admin.campaigns.downloadTemplateStudentGroup');
        Route::get('/{campaign}', [CampaignController::class, 'show'])->name('admin.campaigns.show');
        Route::get('/{campaign}/edit', [CampaignController::class, 'edit'])->name('admin.campaigns.edit');
    });
    Route::prefix('plans')->group(function (): void {
        Route::get('/', [PlanController::class, 'index'])->name('admin.plans.index');
        Route::get('/create', [PlanController::class, 'create'])->name('admin.plans.create');
        Route::get('/{plan}', [PlanController::class, 'show'])->name('admin.plans.show');
        Route::get('/{plan}/edit', [PlanController::class, 'edit'])->name('admin.plans.edit');
        Route::get('/{plan}/detail/create', [PlanController::class, 'createPlanDetail'])->name('admin.plans.createPlanDetail');
        Route::get('/{planDetail}/detail/edit', [PlanController::class, 'editPlanDetail'])->name('admin.plans.editPlanDetail');
    });

    // Route::prefix('users')->group(function (): void {
    //     Route::get('/', [UserController::class, 'index'])->name('admin.users.index');

    // });

    Route::prefix('teachers')->group(function (): void {
        Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
        Route::get('/download-template-teacher', [TeacherController::class, 'downloadTemplateTeacher'])->name('admin.teachers.downloadTemplateTeacher');
        Route::get('/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
    });

    Route::prefix('companies')->group(function (): void {
        Route::get('/', [CompanyController::class, 'index'])->name('admin.companies.index');
        Route::get('/create', [CompanyController::class, 'create'])->name('admin.companies.create');
        Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('admin.companies.edit');
    });

    Route::prefix('company-campaign')->group(function (): void {
        Route::get('/', [CompanyController::class, 'companyCampaignIndex'])->name('admin.company-campaign.index');
        Route::get('/{campaign}/show', [CompanyController::class, 'companyCampaignShow'])->name('admin.company-campaign.show');
    });

    Route::prefix('report')->group(function (): void {
        Route::get('/', [ReportController::class, 'index'])->name('admin.reports.index');
        Route::get('/{campaignId}/show', [ReportController::class, 'show'])->name('admin.reports.show');
    });

    Route::prefix('topic')->group(function (): void {
        Route::get('/', [TopicController::class, 'index'])->name('admin.topics.index');
        Route::get('/{campaignId}/show', [TopicController::class, 'show'])->name('admin.topics.show');
    });

    //    Route::get('coming-soon', fn () => view('coming-soon'))->name('admin.coming-soon');
});
Route::get('internship/{campaign}/register', [RegisterController::class, 'index'])->name('internship.register');
Route::get('internship/{campaign}/research', [ResearchController::class, 'index'])->name('internship.research');
Route::get('internship/{campaign}/research-official', [ResearchController::class, 'official'])->name('internship.research-official');
Route::get('internship/{key}/edit', [EditGroupController::class, 'index'])->name('internship.edit');
Route::get('internship/{key}/report', [EditGroupController::class, 'report'])->name('internship.report');

Route::prefix('teacher')->group(function (): void {
    Route::get('/', [TeacherController::class, 'login'])->name('teacher.teacher-login');

    Route::middleware('auth:teacher')->group(function (): void {
        Route::get('/student-groups-campaign', [TeacherController::class, 'campaigns'])
            ->name('teacher.student-groups-campaign');

        Route::get('/student-groups-campaign/{campaignId}/show', [TeacherController::class, 'groups'])
            ->name('teacher.student-groups-campaign.show');

        Route::post('/logout', [TeacherController::class, 'logout'])
            ->name('teacher.logout');

        Route::get('/topic', [TeacherController::class, 'topic'])
            ->name('teacher.topics');

        Route::get('/topic/create', [TeacherController::class, 'topicCreate'])
            ->name('teacher.topics.create');

        Route::get('/topic/edit/{id}', [TeacherController::class, 'topicEdit'])
            ->name('teacher.topics.edit');

        Route::get('/account', [TeacherController::class, 'teacherAccount'])
            ->name('teacher.account');
    });
});
