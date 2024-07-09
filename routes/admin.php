<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\CrfCourseController;
use App\Http\Controllers\Site\IntrestedStudentController;
use App\Http\Controllers\Site\ProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashbaordController;
use App\Http\Controllers\Admin\AccountTreeController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController as UserContactController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PlatformController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WorkHoursController;
use App\Http\Requests\Site\IntresetedStudentRegisterRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!b
|
*/


Auth::routes(['register' => false]);

Route::middleware('auth:admin')
    ->name('admin.')->group(function () {
        Route::redirect('/', '/admin/dashboard', 301);
        Route::get('/dashboard', [DashbaordController::class, 'dashboard'])->name('dashboard');
        // Contacts
        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::get('', [UserContactController::class, 'index'])->name('index');
            Route::delete('/delete/{id}', [UserContactController::class, 'destroy'])->name('destroy');
            Route::get('/table-data', [UserContactController::class, 'getTableData'])->name('table');
        });
        // Pages
        Route::prefix('pages')->name('page.')->group(function () {
            Route::get('edit/home', [PageController::class, 'editHomePage'])->name('edit_home');
            Route::get('edit/{slug}', [PageController::class, 'edit'])->name('edit');
            Route::post('update/{slug}', [PageController::class, 'update'])->name('update');
            Route::post('update/home/page', [PageController::class, 'updateHomePage'])->name('update_home');
        });
        // Services
        Route::prefix('services')->name('service.')->group(function () {
            Route::get('', [ServiceController::class, 'index'])->name('index');
            Route::post('store', [ServiceController::class, 'store'])->name('store');
            Route::post('/{service}/update', [ServiceController::class, 'update'])->name('update');
            Route::delete('/{service}/delete', [ServiceController::class, 'destroy'])->name('destroy');
            Route::get('/status-toggle', [ServiceController::class, 'toggleStatus'])->name('toggle_status');
            Route::get('/table-data', [ServiceController::class, 'getTableData'])->name('table');
        });
        // Barbers
        Route::prefix('platforms')->name('platform.')->group(function () {
            Route::get('', [PlatformController::class, 'index'])->name('index');
            Route::post('store', [PlatformController::class, 'store'])->name('store');
            Route::post('/{service}/update', [PlatformController::class, 'update'])->name('update');
            Route::delete('/{service}/delete', [PlatformController::class, 'destroy'])->name('destroy');
            Route::get('/status-toggle', [PlatformController::class, 'toggleStatus'])->name('toggle_status');
            Route::get('/table-data', [PlatformController::class, 'getTableData'])->name('table');
        });
        // Work Hours
        Route::prefix('work-hours')->name('work_hour.')->group(function () {
            Route::get('edit', [WorkHoursController::class, 'edit'])->name('edit');
            Route::post('store', [WorkHoursController::class, 'store'])->name('store');
        });
        // Bookings
        Route::prefix('orders')->name('order.')->group(function () {
            Route::get('', [OrderController::class, 'index'])->name('index');
            Route::get('/table-data', [OrderController::class, 'getTableData'])->name('table');
            Route::delete('/destroy/{id}', [OrderController::class, 'destroy'])->name('destroy');
        });
        // Work Hours
        Route::prefix('site-settings')->name('setting.')->group(function () {
            Route::get('edit', [SettingController::class, 'edit'])->name('edit');
            Route::post('update', [SettingController::class, 'update'])->name('update');
        });
    });
