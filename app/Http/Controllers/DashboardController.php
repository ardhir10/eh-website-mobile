<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.home', [
            'companies' => Company::count(),
            'sites' => Site::count(),
            'users' => User::count(),
        ]);
    }

    public function create()
    {
        return redirect()->back()->with('success', 'Company created successfully');
    }
}
