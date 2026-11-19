<?php
// Deskripsi file: routes/web.php
// Mengelola halaman profil pengguna.
use App\Http\Controllers\ProfileController;
// Mengelola operasi CRUD untuk post.
use App\Http\Controllers\PostController;
// Menyediakan registrasi dan eksekusi route Laravel.
use Illuminate\Support\Facades\Route;
// Merender halaman menggunakan Inertia.
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/

// Menampilkan landing page untuk tamu atau mengarahkan pengguna login ke Data Saya.
Route::get('/welcome', function () {
    if (auth()->check()) {
        return redirect()->route('posts.index');
    }

    return view('welcome');
})->name('welcome');

// Tampilkan landing page untuk tamu dan Data Saya untuk pengguna yang sudah masuk.
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('posts.index');
    }

    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Protected Routes (Hanya untuk user yang sudah login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Tetap mengarahkan jalur dashboard lama ke halaman Data Saya.
    Route::get('/dashboard', function () {
        return redirect()->route('posts.index');
    })->name('dashboard');

    // CRUD Posts
    Route::resource('posts', PostController::class);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Login, Register, Logout bawaan Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';