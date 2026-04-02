<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Cek berdasarkan role user
        switch ($user->role) {
            case 'dokter':
                return redirect()->route('home'); // arahkan ke dashboard dokter/admin
            case 'pasien':
                return redirect('/#reservasi'); // arahkan ke halaman utama pasien (langsung ke bagian reservasi)
            default:
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'Akun tidak memiliki hak akses yang valid.',
                ]);
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
