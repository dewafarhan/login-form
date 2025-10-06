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
        $credentials = $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $redirect_url = $user->role == 'staff' ? '/staff' : '/dashboard';

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successful! Redirecting...',
                    'redirect_url' => $redirect_url
                ]);
            }
            return redirect()->intended($redirect_url);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Email atau password salah.',
            ], 422);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
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
