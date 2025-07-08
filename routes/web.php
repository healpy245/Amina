<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/clients/search', [\App\Http\Controllers\ClientController::class, 'search'])->name('clients.search');
Route::get('/dresses/search', [\App\Http\Controllers\DressController::class, 'search'])->name('dresses.search');
Route::get('/contracts/search', [\App\Http\Controllers\ContractController::class, 'search'])->name('contracts.search');
Route::get('/appointments/search', [\App\Http\Controllers\AppointmentController::class, 'search'])->name('appointments.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('categories/bulk-delete', [App\Http\Controllers\CategoryController::class, 'bulkDelete'])->name('categories.bulkDelete');
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::post('dresses/bulk-delete', [App\Http\Controllers\DressController::class, 'bulkDelete'])->name('dresses.bulkDelete');
    Route::resource('dresses', App\Http\Controllers\DressController::class);
    Route::post('clients/bulk-delete', [App\Http\Controllers\ClientController::class, 'bulkDelete'])->name('clients.bulkDelete');
    Route::resource('clients', App\Http\Controllers\ClientController::class);
    Route::post('appointments/bulk-delete', [App\Http\Controllers\AppointmentController::class, 'bulkDelete'])->name('appointments.bulkDelete');
    Route::resource('appointments', App\Http\Controllers\AppointmentController::class);
    Route::post('contracts/bulk-delete', [App\Http\Controllers\ContractController::class, 'bulkDelete'])->name('contracts.bulkDelete');
    Route::resource('contracts', App\Http\Controllers\ContractController::class);
    Route::post('payments/bulk-delete', [App\Http\Controllers\PaymentController::class, 'bulkDelete'])->name('payments.bulkDelete');
    Route::resource('payments', App\Http\Controllers\PaymentController::class);
});

Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar', 'he'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('lang.switch');

require __DIR__.'/auth.php';

