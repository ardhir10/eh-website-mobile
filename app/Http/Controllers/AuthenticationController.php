<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function index()
    {
        return 'Not Found';
    }

    public function signin(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'login' => 'required|string', // This will accept either username or email
                'password' => 'required|string',
            ]);

            $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            
            $attemptData = [
                $loginField => $credentials['login'],
                'password' => $credentials['password'],
            ];

            if (Auth::attempt($attemptData)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }

            return back()->withErrors([
                'login' => 'The provided credentials do not match our records.',
            ])->withInput($request->except('password'));
        }

        return view('auth.signin');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect()->route('auth.signin');
    }
}
