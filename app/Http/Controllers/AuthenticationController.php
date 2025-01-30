<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

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

    public function loginMobile(Request $request)
    {
        try {
            // Validate request with API-specific rules
            $credentials = $request->validate([
                'login' => ['required', 'string', 'min:3', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
            ], [
                'login.required' => 'Username or email is required',
                'login.string' => 'Username or email must be a string',
                'login.min' => 'Username or email must be at least 3 characters',
                'login.max' => 'Username or email must not exceed 255 characters',
                'password.required' => 'Password is required',
                'password.string' => 'Password must be a string',
                'password.min' => 'Password must be at least 6 characters',
            ]);

            // Check if login is email or username
            $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            
            // Find user
            $user = User::where($loginField, $credentials['login'])->first();

            // Load company
            $user->load('company');
            
            // Check if user exists and password is correct
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                    'errors' => [
                        'login' => ['User with this email/username does not exist']
                    ]
                ], 401);
            }

            if (!Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credentials',
                    'errors' => [
                        'password' => ['Password is incorrect']
                    ]
                ], 401);
            }

            // Create tokens with expiration
            $tokenExpiry = now()->addDays(1); // 24 hours for access token
            $refreshTokenExpiry = now()->addDays(30); // 30 days for refresh token
            
            $token = Str::random(64); // Generate simple random token
            $refreshToken = Str::random(64); // Generate simple random refresh token
            
            // Update user with refresh token and expiration times
            $user->update([
                'token' => $token,
                'refresh_token' => $refreshToken,
                'token_expired_at' => $tokenExpiry,
                'refresh_token_expired_at' => $refreshTokenExpiry
            ]);

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
                'refresh_token' => $refreshToken,
                'token_expired_at' => $tokenExpiry,
                'refresh_token_expired_at' => $refreshTokenExpiry
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during login',
                'errors' => [
                    'general' => [$e->getMessage()]
                ]
            ], 500);
        }
    }

    public function refreshToken(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string'
        ]);

        $user = User::where('refresh_token', $request->refresh_token)
                    ->where('refresh_token_expired_at', '>', now())
                    ->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid or expired refresh token'
            ], 401);
        }

        // Create new tokens
        $tokenExpiry = now()->addDays(1);
        $refreshTokenExpiry = now()->addDays(30);
        
        $token = Str::random(64); // Generate simple random token
        $refreshToken = Str::random(64); // Generate simple random refresh token
        
        // Update user with new tokens
        $user->update([
            'token' => $token,
            'refresh_token' => $refreshToken,
            'token_expired_at' => $tokenExpiry,
            'refresh_token_expired_at' => $refreshTokenExpiry
        ]);

        return response()->json([
            'token' => $token,
            'refresh_token' => $refreshToken,
            'token_expired_at' => $tokenExpiry,
            'refresh_token_expired_at' => $refreshTokenExpiry
        ], 200);
    }
}
