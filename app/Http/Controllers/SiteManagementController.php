<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Company;

class SiteManagementController extends Controller
{
    public function index()
    {
        $sites = Site::with('company')->orderBy('created_at', 'desc')->get();
        $companies = Company::orderBy('company_name', 'asc')->get();
        return view('site-management.index', compact('sites', 'companies'));
    }

    public function create()
    {
        $companies = Company::orderBy('company_name', 'asc')->get();
        return view('site-management.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'site_name' => 'required|string|max:255',
            'site_address' => 'required|string',
            'site_phone' => 'required|string|max:20',
            'site_email' => 'required|email|max:255',
            'site_longitude' => 'nullable|string|max:255',
            'site_latitude' => 'nullable|string|max:255',
            'site_visibility' => 'required|in:all,private',
            'site_status' => 'boolean',
        ]);

        // Generate unique site token
        $validated['site_token'] = \Str::random(32);
        
        Site::create($validated);

        return redirect()
            ->route('site-management.index')
            ->with('success', 'Site created successfully');
    }

    public function show($id)
    {
        $site = Site::find($id);
        return view('site-management.show', compact('site'));
    }

    public function edit($id)
    {
        $site = Site::findOrFail($id);
        $companies = Company::orderBy('company_name', 'asc')->get();
        return view('site-management.edit', compact('site', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $site = Site::findOrFail($id);
        
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'site_name' => 'required|string|max:255',
            'site_address' => 'required|string',
            'site_phone' => 'required|string|max:20',
            'site_email' => 'required|email|max:255',
            'site_longitude' => 'nullable|string|max:255',
            'site_latitude' => 'nullable|string|max:255',
            'site_visibility' => 'required|in:all,private',
            'site_status' => 'boolean',
        ]);
        
        $site->update($validated);

        return redirect()
            ->route('site-management.index')
            ->with('success', 'Site updated successfully');
    }

    public function destroy($id)
    {
        $site = Site::findOrFail($id);
        $site->delete();

        return redirect()
            ->route('site-management.index')
            ->with('success', 'Site deleted successfully');
    }

    public function getSitesByCompanyId($companyId)
    {
        $sites = Site::where('company_id', $companyId)
            ->where('site_status', true)
            ->select([
                'id',
                'site_name',
                'site_address',
                'site_phone',
                'site_email',
                'site_longitude',
                'site_latitude',
                'site_visibility',
                'site_token'
            ])
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $sites
        ]);
    }
}
