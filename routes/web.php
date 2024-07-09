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
use App\Http\Controllers\Admin\ContactController as UserContactController;
use App\Http\Controllers\Site\BookingController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');
// Site Routes
Route::group([
    'as' => 'site.'
], function () {
    Route::get('services/{platform_id}', [HomeController::class, 'services'])->name('services');
    Route::get('offer/{service_id}', [HomeController::class, 'redirectToOffer'])->name('offer_redirect');
    Route::get('task/complete', [HomeController::class, 'taskCompleted'])->name('task_completed');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('order-confirm/{order_id}', [HomeController::class, 'confirmOrder'])->name('confirm_order');
    Route::post('contact-submit', [ContactController::class, 'store'])->name('contact.submit');
    // certifed freelancer courses
    Route::prefix('booking')->name('booking.')->group(function () {
        Route::post('/store', [BookingController::class, 'store'])->name('store');
        Route::get('/fetch-available-times', [BookingController::class, 'fetchAvailableTimes'])->name('fetch_available_times');
    });
});
