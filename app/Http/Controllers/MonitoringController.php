<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Site;

class MonitoringController extends Controller
{
    public function index()
    {
        $company = Company::orderBy('id', 'desc')->get();
        
        

        // if role Super Admin
        if (auth()->user()->role == \App\Models\User::ROLE_SUPER_ADMIN) {
            $breadcrumbs = [
                [
                    'title' => 'Overview',
                    'url' => route('monitoring.index'),
                    'icon' => true // will use home icon
                ],
                [
                    'title' => 'Company List',
                    'url' => route('monitoring.index')
                ],
               
            ];
            return view('monitoring.index-super-admin', compact('company', 'breadcrumbs'));
        }else{
            // redirect to monitoring.show
            return redirect()->route('monitoring.show');
        }
        
    }

    public function show($id = null)
    {
        if (auth()->user()->role == \App\Models\User::ROLE_SUPER_ADMIN) {
            $company = Company::findOrFail($id);
            $breadcrumbs = [
                [
                    'title' => 'Overview',
                    'url' => route('monitoring.index'),
                    'icon' => true
                ],
                [
                    'title' => 'Company List',
                    'url' => route('monitoring.index')
                ],
                [
                    'title' => $company->company_name,
                    'url' => route('monitoring.show', $company->id)
                ]
            ];
        } else {
            $company = Company::findOrFail(auth()->user()->company_id);
            $breadcrumbs = [
                [
                    'title' => 'Overview',
                    'url' => route('monitoring.index'),
                    'icon' => true
                ],
                [
                    'title' => $company->company_name,
                    'url' => route('monitoring.show', $company->id)
                ]
            ];
        }

        
        
        

        return view('monitoring.company-details', compact('company', 'breadcrumbs'));
    }

    public function siteDetails($id)
    {
        $site = Site::findOrFail($id);
        // if not super admin validate the company id
        if (auth()->user()->role != \App\Models\User::ROLE_SUPER_ADMIN) {
            if (auth()->user()->company_id != $site->company_id) {
                return redirect()->route('monitoring.show')->with('failed', 'Unauthorized access. You are not authorized to access this site.');
            }
        }
        // Breadcrumbs  
        $breadcrumbs = [
            [
                'title' => 'Overview',
                'url' => route('monitoring.index'),
                'icon' => true
            ],
            [
                'title' => $site->company->company_name,
                'url' => route('monitoring.index')
            ],
            [
                'title' => $site->site_name,
                'url' => route('monitoring.site-details', $site->id)
            ]
        ];
        return view('monitoring.site-details', compact('site', 'breadcrumbs'));
    }
}

