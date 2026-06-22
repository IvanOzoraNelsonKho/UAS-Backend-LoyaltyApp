<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Masuk (Login)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika admin, langsung arahkan ke dashboard misi admin, jika customer ke profilnya
            if (Auth::user()->is_admin) {
                return redirect()->route('users.index');
            }
            
            return redirect()->route('users.show', Auth::id());
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    // Tampilkan Form Sign Up (Register)
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Pendaftaran Akun Baru (Sign Up)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Ambil ID Tier paling rendah (Silver/Basic) yang min_points-nya 0
        $defaultTier = Tier::where('min_points', 0)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'point_balance' => 0, // Saldo awal customer baru adalah 0
            'tier_id' => $defaultTier ? $defaultTier->id : null,
            'is_admin' => false, // Otomatis mendaftar sebagai customer biasa
        ]);

        // Otomatis login setelah berhasil mendaftar
        Auth::login($user);

        return redirect()->route('users.show', $user->id)->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }

    // Proses Keluar (Logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }

    
}