<?php
// Deskripsi file: routes/auth.php

// Controller ini menangani halaman dan proses autentikasi pengguna.
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

// Route Laravel digunakan untuk membuat URL yang terhubung ke controller.
use Illuminate\Support\Facades\Route;

// Kelompok route berikut hanya dapat diakses oleh pengguna yang belum login.
Route::middleware('guest')->group(function () {
    // Menampilkan dan memproses formulir pendaftaran akun baru.
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    // Menampilkan dan memproses formulir login pengguna.
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Mengirim tautan untuk mereset kata sandi yang terlupa.
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    // Menampilkan formulir reset kata sandi menggunakan token khusus.
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

// Kelompok route berikut hanya dapat diakses oleh pengguna yang sudah login.
Route::middleware('auth')->group(function () {
    // Menampilkan pemberitahuan jika alamat email belum diverifikasi.
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    // Memvalidasi tautan verifikasi email beserta tanda tangan URL.
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    // Mengirim ulang pemberitahuan verifikasi dengan batas percobaan.
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    // Meminta pengguna mengonfirmasi kata sandi sebelum melanjutkan.
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Memperbarui kata sandi pengguna yang sedang login.
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Mengakhiri sesi login pengguna.
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
