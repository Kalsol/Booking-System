<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::get('appointments/schedule', [AppointmentController::class, 'schedule'])->name('appointments.schedule');
    Route::resource('services', ServiceController::class);
    Route::resource('staff', StaffController::class);
    Route::get('billing', [BillingController::class, 'index'])->name('billing');

});

require __DIR__.'/settings.php';
