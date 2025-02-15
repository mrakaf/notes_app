<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        try {
            \Log::info('Signup attempt', $request->all());
            $request->validate([
                'username' => 'required|string|max:50',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:8|confirmed'
            ]);

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60)
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran berhasil!'
                ], 200);
            }

            return redirect()->route('login.form')
                ->with('success', 'Pendaftaran berhasil! Silakan login.');
        } catch (\Exception $e) {
            \Log::error('Signup error: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->with('error', 'Terjadi kesalahan saat mendaftar.');
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Login berhasil'
                    ]);
                }

                return redirect()->route('notes.index');
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah'
                ], 422);
            }

            return back()->withErrors([
                'email' => 'Email atau password salah'
            ]);
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan'
                ], 500);
            }

            return back()->withErrors(['email' => 'Terjadi kesalahan']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil logout.');
    }

    public function loginAndSaveNote(Request $request) 
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',
                    'token' => csrf_token() // Kirim token baru untuk request selanjutnya
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Login for save note error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat login'
            ], 500);
        }
    }
} 