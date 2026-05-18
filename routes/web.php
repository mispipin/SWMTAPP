<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.welcome');
});

Route::get('/student/register', [StudentAuthController::class, 'showRegister'])->name('student.register');
Route::post('/student/register', [StudentAuthController::class, 'register'])->name('student.register.process');
Route::get('/student/login', [StudentAuthController::class, 'showLogin'])->name('student.login');
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login.process');
Route::get('/student/auth/google', [StudentAuthController::class, 'redirectToGoogle'])->name('student.google');
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

Route::get('/register-test', [UserRegistrationController::class, 'showForm'])->name('register.test');
Route::post('/register-test', [UserRegistrationController::class, 'store'])->name('register.test.store');
Route::get('/test-guide/{registration}', [UserRegistrationController::class, 'showGuide'])->name('test.guide');
Route::post('/logout', [UserRegistrationController::class, 'logout'])->name('user.logout');
Route::get('/test/{registration}', [UserRegistrationController::class, 'startTest'])->name('test.start');
Route::get('/test-fruit/{registration}', [UserRegistrationController::class, 'showFruitStage'])->name('test.fruit');
Route::get('/test-result/{registration}', [UserRegistrationController::class, 'showResult'])->name('test.result');
Route::get('/test-result/{registration}/pdf', [UserRegistrationController::class, 'exportResultPdf'])->name('test.result.pdf');

// Route guru dibuat terpisah dari route awal halaman utama.
Route::get('/teacher/register', [AdminAuthController::class, 'showRegister'])->name('teacher.register');
Route::post('/teacher/register', [AdminAuthController::class, 'register'])->name('teacher.register.process');
Route::get('/teacher/login', [AdminAuthController::class, 'showLogin'])->name('teacher.login');
Route::post('/teacher/login', [AdminAuthController::class, 'login'])->name('teacher.login.process');
Route::get('/auth/google', [AdminAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AdminAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/teacher/logout', [AdminAuthController::class, 'logout'])->name('teacher.logout');
Route::get('/teacher/dashboard', [AdminRegistrationController::class, 'adminIndex'])->name('teacher.dashboard');
Route::post('/teacher/classes', [AdminRegistrationController::class, 'storeClass'])->name('teacher.classes.store');
Route::delete('/teacher/classes/{teacherClass}', [AdminRegistrationController::class, 'destroyClass'])->name('teacher.classes.destroy');
Route::get('/teacher/swmt-users', [AdminRegistrationController::class, 'adminIndex'])->name('teacher.swmt.users');
Route::get('/teacher/registrations/{registration}/edit', [AdminRegistrationController::class, 'edit'])->name('teacher.registrations.edit');
Route::put('/teacher/registrations/{registration}', [AdminRegistrationController::class, 'update'])->name('teacher.registrations.update');
Route::get('/teacher/export-pdf', [AdminRegistrationController::class, 'exportPdf'])->name('teacher.export.pdf');
Route::delete('/teacher/registrations/{registration}', [AdminRegistrationController::class, 'destroy'])->name('teacher.registrations.destroy');
Route::get('/teacher/profile', [AdminRegistrationController::class, 'editProfile'])->name('teacher.profile.edit');
Route::put('/teacher/profile', [AdminRegistrationController::class, 'updateProfile'])->name('teacher.profile.update');

// Super Admin Routes
Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
Route::get('/superadmin/export-pdf', [SuperAdminController::class, 'exportPdf'])->name('superadmin.export.pdf');
Route::delete('/superadmin/registrations/{registration}', [SuperAdminController::class, 'destroy'])->name('superadmin.registrations.destroy');
