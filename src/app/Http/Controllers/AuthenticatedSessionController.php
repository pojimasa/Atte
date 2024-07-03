<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/stamp');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'メールアドレス、またはパスワードが違います',
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showLogoutConfirm()
    {
        return view('auth.logout-confirm');
    }


    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'ログアウトしました。');
    }
}
