<?php

use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\HomeController;
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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('handleLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('handleLogout');

Route::prefix('admin')->middleware(['auth'])->group(function (): void {
    Route::get('/', fn () => redirect()->route('admin.campaigns.index'));
    Route::get('/dashboard', fn () => view('pages.dashboard'))->name('admin.dashboard');
    Route::prefix('campaigns')->group(function (): void {
        Route::get('/', [CampaignController::class, 'index'])->name('admin.campaigns.index');
        Route::get('/create', [CampaignController::class, 'create'])->name('admin.campaigns.create');
        Route::get('/{campaign}', [CampaignController::class, 'show'])->name('admin.campaigns.show');
        Route::get('/{campaign}/edit', [CampaignController::class, 'edit'])->name('admin.campaigns.edit');

    });

    Route::prefix('users')->group(function (): void {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');

    });

    Route::get('coming-soon', fn () => view('coming-soon'))->name('admin.coming-soon');
});
Route::get('internship/{campaign}/register', [RegisterController::class, 'index'])->name('internship.register');
