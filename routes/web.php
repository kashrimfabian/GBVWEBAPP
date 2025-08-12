<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\AnonymousReportController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/login', function () {
    return Inertia::render('Auth/Login', [
        'canResetPassword' => true,
        'status' => session('status'),
    ]);
})->name('login')->middleware('guest');

/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
*/
Route::resource('categories', CategoryController::class);


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/anonymous-reports/create', [AnonymousReportController::class, 'create'])->name('report.create');
Route::post('/anonymous-reports', [AnonymousReportController::class, 'store'])->name('report.store');
Route::get('/anonymous-reports/index', [AnonymousReportController::class, 'index'])->name('report.index');
Route::get('/anonymous-reports/{reprt_id}', [AnonymousReportController::class, 'show'])->name('report.show');

/*
|--------------------------------------------------------------------------
| Password Change Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/change-password', [PasswordController::class, 'edit'])->name('password.change');
    Route::put('/change-password', [PasswordController::class, 'update'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated & Force Password Change Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'force'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Roles Routes (Authenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class)
        ->names([
            'index' => 'role.index',
            'create' => 'role.create',
            'store' => 'role.store',
            'show' => 'role.show',
            'edit' => 'role.edit',
            'update' => 'role.update',
            'destroy' => 'role.destroy',
        ]);
});

/*
|--------------------------------------------------------------------------
| Users Routes (Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);

    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])
        ->name('users.reset-password');

    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');
});

/*
|--------------------------------------------------------------------------
| Additional Route Files
|--------------------------------------------------------------------------
*/
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
