<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserManagementController extends Controller
{
    public function index()
    {
        $pageTitle = 'User Management';
        $pageDescription = 'Manage all users in your system';
        $users = User::with('company')->orderBy('id', 'desc')->get();
        
        return view('user-management.index', compact('pageTitle', 'pageDescription', 'users'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('user-management.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $rules = [
            'username' => [
                'required',
                'unique:users,username',
                'min:4',
                'max:20',
                'regex:/^[a-zA-Z0-9_-]*$/',
            ],
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:6',
                'confirmed',
                // 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/'
            ],
            'role' => ['required', 'in:' . implode(',', array_keys(User::getRoles()))],
            'avatar' => 'nullable|image|max:2048|mimes:jpg,jpeg,png'
        ];

        // Add company_id validation only if role is not super_admin
        if ($request->input('role') !== User::ROLE_SUPER_ADMIN) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        $validated = $request->validate($rules, [
            'username.regex' => 'Username may only contain letters, numbers, dashes and underscores.',
            'password.regex' => 'Password must contain at least one letter and one number.',
            'password.confirmed' => 'Password confirmation does not match.',
            'company_id.required' => 'Company is required for non-Super Admin roles.',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['status'] = 'active';
        
        // Only set company_id if role is not super_admin
        if ($request->input('role') !== User::ROLE_SUPER_ADMIN) {
            $validated['company_id'] = $request->input('company_id');
        }

        User::create($validated);

        return redirect()->route('user-management.index')
            ->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $companies = Company::all();
        $pageTitle = 'Edit User';
        $pageDescription = 'Update user information';

        return view('user-management.edit', compact('user', 'companies', 'pageTitle', 'pageDescription'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'username' => [
                'required',
                'min:4',
                'max:20',
                'regex:/^[a-zA-Z0-9_-]*$/',
                'unique:users,username,' . $id,
            ],
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => ['required', 'in:' . implode(',', array_keys(User::getRoles()))],
            'avatar' => 'nullable|image|max:2048|mimes:jpg,jpeg,png'
        ];

        // Add password validation only if password is being updated
        if ($request->filled('password')) {
            $rules['password'] = [
                'required',
                'min:6',
                'confirmed',
                // 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/'
            ];
        }

        // Add company_id validation only if role is not super_admin
        if ($request->input('role') !== User::ROLE_SUPER_ADMIN) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        $validated = $request->validate($rules, [
            'username.regex' => 'Username may only contain letters, numbers, dashes and underscores.',
            'password.regex' => 'Password must contain at least one letter and one number.',
            'password.confirmed' => 'Password confirmation does not match.',
            'company_id.required' => 'Company is required for non-Super Admin roles.',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Only update password if it's provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Handle company_id based on role
        if ($request->input('role') === User::ROLE_SUPER_ADMIN) {
            $validated['company_id'] = null;
        }

        $user->update($validated);

        return redirect()->route('user-management.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting self
        if (auth()->id() === $user->id) {
            return redirect()->route('user-management.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Delete avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Soft delete the user
        $user->delete();

        return redirect()->route('user-management.index')
            ->with('success', 'User deleted successfully');
    }

    public function show($id)
    {
        $user = User::with('company')->findOrFail($id);
        $pageTitle = 'User Details';
        $pageDescription = 'View user information';

        return view('user-management.show', compact('user', 'pageTitle', 'pageDescription'));
    }
}
