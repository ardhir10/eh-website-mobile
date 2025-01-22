<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class DataCompanyController extends Controller
{
    public function index()
    {
        $pageTitle = 'Data Company';
        $companies = Company::orderBy('created_at', 'desc')->get();
        return view('data-company.index', compact('pageTitle', 'companies'));
    }

    public function create()
    {
        $pageTitle = 'Create Company';
        return view('data-company.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_phone' => 'required|string|max:20',
            'company_email' => 'required|email|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'company_address' => 'required|string',
            'company_description' => 'nullable|string',
        ]);

        if ($request->hasFile('company_logo')) {
            $logo = $request->file('company_logo');
            $logoPath = $logo->store('company-logos', 'public');
            $validated['company_logo'] = $logoPath;
        }

        Company::create($validated);

        return redirect()
            ->route('data-company.index')
            ->with('success', 'Company created successfully');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company->company_logo) {
            Storage::disk('public')->delete($company->company_logo);
        }
        $company->delete();
        return redirect()
            ->route('data-company.index')
            ->with('success', 'Company deleted successfully');
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Company';
        $company = Company::findOrFail($id);
        return view('data-company.edit', compact('pageTitle', 'company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_phone' => 'required|string|max:20',
            'company_email' => 'required|email|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'company_address' => 'required|string',
            'company_description' => 'nullable|string',
        ]);

        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            if ($company->company_logo) {
                Storage::disk('public')->delete($company->company_logo);
            }
            
            $logo = $request->file('company_logo');
            $logoPath = $logo->store('company-logos', 'public');
            $validated['company_logo'] = $logoPath;
        }

        $company->update($validated);

        return redirect()
            ->route('data-company.index')
            ->with('success', 'Company updated successfully');
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('data-company.show', compact('company'));
    }
}

