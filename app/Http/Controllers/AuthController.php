<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function login(Request $request) {
        // Validasi input
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);

        // Mencoba otentikasi pengguna
        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();

            // Menentukan URL redirect berdasarkan role
            $redirect_url = Auth::user()->role == 'staff' ? '/staff' : '/dashboard';

            // Mengembalikan response JSON jika berhasil
            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil! Anda akan dialihkan...',
                'redirect_url' => $redirect_url
            ]);
        }

        // Mengembalikan response JSON jika gagal dengan status 401 (Unauthorized)
        return response()->json([
            'status' => 'error',
            'message' => 'Email atau password yang Anda masukkan salah.'
        ], 401);
    }

    function register(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|max:50|min:8',
            'confirm_password' => 'required|max:50|min:8|same:password',
        ]);
        $request['status'] = "verify";
        $user = User::create($request->all());
        Auth::login($user);
        return redirect('/staff');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
