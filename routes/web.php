<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Doctors
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Promos
Route::get('/promos', [PromoController::class, 'index'])->name('promos.index');
Route::get('/promos/{promo}', [PromoController::class, 'show'])->name('promos.show');

// Appointments
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments/success', [AppointmentController::class, 'success'])->name('appointments.success');

// Health Check
Route::get('/health-check', [HealthCheckController::class, 'index'])->name('health-check.index');
Route::get('/health-check/form', [HealthCheckController::class, 'create'])->name('health-check.create');
Route::post('/health-check', [HealthCheckController::class, 'store'])->name('health-check.store');
Route::get('/health-check/result/{id}', [HealthCheckController::class, 'result'])->name('health-check.result');
