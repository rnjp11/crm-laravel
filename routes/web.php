<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\EnquiryshowController;
use App\Http\Controllers\LoginAuthenticator;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
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

Route::get('/products', function () {
    return view('list-products');
});
// Route::get('/welcome', function () {
//     return view('welcome');
// });



Route::get('login', [LoginAuthenticator::class, 'login'])->name('login');
Route::get('demo', [LoginAuthenticator::class, 'demo'])->name('demo');

Route::post('login', [LoginAuthenticator::class, 'loginCheck'])->name('login');
Route::get('logout', [LoginAuthenticator::class, 'logout'])->name('logout');


Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
    Route::post('/enquiry/update-status', 'updateStatus')->name('enquiry.updateStatus');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('user.index');
    Route::post('/user', 'store')->name('user');
    Route::get('/user/{id}', 'edit')->name('user.edit');
    Route::put('/user/{id}', 'update')->name('user.update');
    Route::delete('/user/{id}', 'destroy')->name('user.delete');
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('/service', 'index')->name('service.index');
    Route::post('/service', 'store')->name('service.add');
    Route::get('/service/{id}/edit', 'edit')->name('service.edit');
    Route::put('/service/{id}', 'update')->name('service.update');
    Route::delete('/service/{id}', 'destroy')->name('service.delete');
});

Route::controller(ReferenceController::class)->group(function () {
    Route::get('/reference', 'index')->name('reference.index');
    Route::post('/reference', 'store')->name('reference.add');
    Route::get('/reference/{id}/edit', 'edit')->name('reference.edit');
    Route::put('/reference/{id}', 'update')->name('reference.update');
    Route::delete('/reference/{id}', 'destroy')->name('reference.delete');
});

Route::controller(CityController::class)->group(function () {
    Route::get('/city', 'index')->name('city.index');
    Route::post('/city', 'store')->name('city.add');
    Route::get('/city/{id}/edit', 'edit')->name('city.edit');
    Route::put('/city/{id}', 'update')->name('city.update');
    Route::delete('/city/{id}', 'destroy')->name('city.delete');
});

Route::controller(EnquiryController::class)->group(function () {
    Route::get('/enquiry', 'index')->name('enquiry.index');
    Route::post('/enquiry', 'store')->name('enquiry.add');
    Route::get('/enquiry/{id}/edit', 'edit')->name('enquiry.edit');
    Route::put('/enquiry/{id}', 'update')->name('enquiry.update');
    Route::delete('/enquiry/{id}', 'destroy')->name('enquiry.delete');
    Route::post('/enquiry/bulk-delete', 'bulkDelete')->name('enquiry.bulkDelete');
    Route::get('/download-enquiries', 'downloadPdf');
    Route::post('/send-enquiry-email', 'sendEnquiryEmail');
    Route::post('/assign-enquiry', 'assignEnquiry');
});

Route::controller(EnquiryshowController::class)->group(function () {
    Route::get('/enquiry-show', 'index')->name('enquiry-show.index');
    Route::post('/enquiry-show', 'store')->name('enquiry-show.add');
    Route::get('/enquiry-show/{id}/edit', 'edit')->name('enquiry-show.edit');
    Route::put('/enquiry-show/{id}', 'update')->name('enquiry-show.update');
    Route::delete('/enquiry-show/{id}', 'destroy')->name('enquiry-show.delete');
    Route::post('/view-enquiry', 'viewmodal');
});
