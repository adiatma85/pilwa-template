<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Controllers
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PermissionsController as AdminPermissionController;
use App\Http\Controllers\Admin\RolesController as AdminRolesController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\PesertaController as AdminPesertaController;
use App\Http\Controllers\Admin\CalonController as AdminCalonController;
use App\Http\Controllers\Admin\PaslonController as AdminPaslonController;
use App\Http\Controllers\Admin\SuaraController as AdminSuaraController;

// Auth Gate
use App\Http\Controllers\Auth\ChangePasswordController as AuthChangePasswordController;

// User Controllers
use App\Http\Controllers\Users\AuthController as UserAuthController;
use App\Http\Controllers\Users\PemilihanController as UserPemilwaController;

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
Route::redirect('/', 'pemilwa-fk/login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});


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

        // Peserta
        Route::delete('peserta/destroy', [AdminPesertaController::class, 'massDestroy'])->name('peserta.massDestroy');
        Route::resource('peserta', AdminPesertaController::class);

        // Calon
        Route::delete('calons/destroy', [AdminCalonController::class, 'massDestroy'])->name('calons.massDestroy');
        Route::post('calons/media', [AdminCalonController::class, 'storeMedia'])->name('calons.storeMedia');
        Route::post('calons/ckmedia', [AdminCalonController::class, 'storeCKEditorImages'])->name('calons.storeCKEditorImages');
        Route::resource('calons', AdminCalonController::class);

        // Paslon
        Route::delete('paslons/destroy', [AdminPaslonController::class, 'massDestroy'])->name('paslons.massDestroy');
        Route::post('paslons/media', [AdminPaslonController::class, 'storeMedia'])->name('paslons.storeMedia');
        Route::post('paslons/ckmedia', [AdminPaslonController::class, 'storeCKEditorImages'])->name('paslons.storeCKEditorImages');
        Route::resource('paslons', AdminPaslonController::class);

        // Suara
        Route::delete('suaras/destroy', [AdminSuaraController::class, 'massDestroy'])->name('suaras.massDestroy');
        Route::resource('suaras', AdminSuaraController::class);
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
        Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');

        // Group kotak-suara
        Route::prefix('kotak-suara')
            // ->middleware(null)
            ->as('kotak-suara.')
            ->group(function () {

                // Pemilihan Controller

                //  BEM
                Route::get('/bem', [UserPemilwaController::class, 'indexBem'])->name('indexBem');
                Route::post('/bem', [UserPemilwaController::class, 'storeBem'])->name('storeBem');

                // // DPM
                Route::get('/dpm', [UserPemilwaController::class, 'indexDpm'])->name('indexDpm');
                Route::post('/dpm', [UserPemilwaController::class, 'storeDpm'])->name('storeDpm');

                // After
                Route::view('/after', 'suara.after')->name('after');
            });

        Route::get('/testing-session-open', [UserAuthController::class, 'testingSessionAuth']);
    });



// Testing Auth Siam Controller
// Route::post('/testing-siam-auth', [SiamAuthController::class, 'auth']);
Route::get('/testing-siam-auth', [SiamAuthController::class, 'auth']);

// Testing View
Route::view('/presbem', 'suara.presbem');
Route::view('/dpm', 'suara.dpm');
Route::view('/after', 'suara.after');
