<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $users = User::latest()->paginate($perPage);
        
        return view('dashboard.users.index', compact('users'));
    }

    public function search(Request $request)
    {
        $query = strtolower($request->input('q'));
        
        // Jika query kosong, ambil semua user dengan pagination
        $users = User::when($query, function($q) use ($query) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $query . '%'])
                  ->orWhereRaw('LOWER(email) LIKE ?', ['%' . $query . '%']);
            })
            ->select('id', 'name', 'email', 'created_at')
            ->latest()
            ->paginate(20)
            ->through(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => 'active',
                    'created_at' => $user->created_at->format('M d, Y'),
                    'delete_url' => route('dashboard.users.destroy', $user->id)
                ];
            });

        // Return response with pagination metadata
        return response()->json([
            'data' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total()
            ]
        ], 200, ['Content-Type' => 'application/json']);
    }

    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah ada',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password harus terdiri dari 8 karakter',
        ]);

        try {
            // Create user
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'user', // Set default role
            ]);

            // Success response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan',
                // 'redirect' => route('dashboard.index'),
                // 'callback' => 'refreshUserList' // optional, jika ada fungsi JS yang perlu dipanggil
            ]);

        } catch (\Exception $e) {
            // Error response for AJAX
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus',
                'remove_element' => 'tr' // Menentukan element yang akan dihapus
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function export(Request $request)
    {
        $format = $request->input('format', 'xlsx');
        $filename = 'users-' . date('Y-m-d');

        $users = User::latest()->get();

        switch ($format) {
            case 'csv':
            case 'xlsx':
                return Excel::download(new UsersExport($users), $filename . '.' . $format);
            
            case 'pdf':
                $users = $users->map(function($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role ?? 'user',
                        'status' => 'active',
                        'created_at' => $user->created_at->format('Y-m-d H:i:s')
                    ];
                });

                $pdf = Pdf::loadView('exports.users-pdf', ['users' => $users]);
                return $pdf->download($filename . '.pdf');
            
            default:
                return response()->json(['error' => 'Format tidak didukung'], 400);
        }
    }
}
