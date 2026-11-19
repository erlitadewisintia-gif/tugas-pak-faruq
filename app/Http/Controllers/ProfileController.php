<?php
// Deskripsi file: app/Http/Controllers/ProfileController.php
namespace App\Http\Controllers;

// Request khusus digunakan untuk memvalidasi pembaruan profil.
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
// Inertia digunakan untuk merender halaman pengaturan profil.
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        // Menampilkan halaman profil beserta status verifikasi email pengguna.
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Menyimpan data profil yang sudah lolos validasi.
        $request->user()->fill($request->validated());

        // Menghapus status verifikasi jika pengguna mengganti alamat email.
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Wajib meminta kata sandi sebelum akun dapat dihapus.
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Mengeluarkan pengguna dari sesi login.
        Auth::logout();

        // Menghapus data akun pengguna dari database.
        $user->delete();

        // Membatalkan seluruh sesi lama dan membuat token baru.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
