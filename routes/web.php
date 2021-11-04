<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Controllers
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PermissionsController as AdminPermissionController;
use App\Http\Controllers\Admin\RolesController as AdminRolesController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Auth\ChangePasswordController as AuthChangePasswordController;

// User Controllers
use App\Http\Controllers\Users\AuthController as UserAuthController;

// Testing Siam Auth Controller
use App\Http\Controllers\SiamAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);
Route::redirect('/', '/login');


// Admin Route
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth'])
    ->group(function () {
        // Home
        Route::get('/', [AdminHomeController::class, 'index'])->name('home');

        // Permissions
        Route::delete('permissions/destroy', [AdminPermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
        Route::resource('permissions', AdminPermissionController::class);

        // Roles
        Route::delete('roles/destroy', [AdminRolesController::class, 'massDestroy'])->name('roles.massDestroy');
        Route::resource('roles', AdminRolesController::class);

        // Users
        Route::delete('users/destroy', [AdminUsersController::class, 'massDestroy'])->name('users.massDestroy');
        Route::resource('users', AdminUsersController::class);
    });

// Profile Route
Route::prefix('profile')
    ->as('profile.')
    ->middleware(['auth'])
    ->group(function () {
        if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
            Route::get('password', [AuthChangePasswordController::class, 'edit'])->name('password.edit');
            Route::post('password', [AuthChangePasswordController::class, 'update'])->name('password.update');
            Route::post('profile', [AuthChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
            Route::post('profile/destroy', [AuthChangePasswordController::class, 'destroyProfile'])->name('password.destroyProfile');
        }
    });

Route::as('user.')
    ->middleware([])
    ->prefix('pemilwa-fk') // Hardcoded
    ->group(function () {
        Route::view('/', 'welcome');

        // User Login
        Route::get('/login', [UserAuthController::class, 'login'])->name('login');
        Route::post('/auth', [UserAuthController::class, 'auth'])->name('auth');
    });



// Testing Auth Siam Controller
// Route::post('/testing-siam-auth', [SiamAuthController::class, 'auth']);
Route::get('/testing-siam-auth', [SiamAuthController::class, 'auth']);
