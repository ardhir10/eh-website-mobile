<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.home');
    }

    public function create()
    {
        return redirect()->back()->with('success', 'Company created successfully');
    }
}
