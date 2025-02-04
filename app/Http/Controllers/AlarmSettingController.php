<?php

namespace App\Http\Controllers;

use App\Models\AlarmSetting;
use App\Models\Site;
use Illuminate\Http\Request;

class AlarmSettingController extends Controller
{
    public function index()
    {
        // Get sites only from user's company
        $sites = Site::whereHas('company', function($query) {
            $query->where('id', auth()->user()->company_id);
        })->get();
        
        // Get alarm settings
        $alarmSettings = AlarmSetting::with('site.company')
            ->whereHas('site.company', function($query) {
                $query->where('id', auth()->user()->company_id);
            })->get();
        
        $breadcrumbs = [
            [
                'title' => 'Alarm Settings',
                'url' => route('monitoring.alarm-settings.index'),
                'icon' => true
            ],
        ];
        
        return view('monitoring.alarm-settings.index', compact('breadcrumbs', 'sites', 'alarmSettings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'parameter' => 'required|string',
            'formula' => 'required|string|in:>,>=,<,<=,=',
            'set_point' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $validated['created_by'] = auth()->user()->name ?? 'System';
        
        AlarmSetting::create($validated);

        return redirect()->route('monitoring.alarm-settings.index')
            ->with('success', 'Alarm setting created successfully.');
    }

    public function update(Request $request, $id)
    {
        $alarmSetting = AlarmSetting::findOrFail($id);
        
        // Check if user has access to this alarm setting
        if ($alarmSetting->site->company_id !== auth()->user()->company_id) {
            abort(403);
        }
        
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'parameter' => 'required|string',
            'formula' => 'required|string|in:>,>=,<,<=,=',
            'set_point' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $validated['updated_by'] = auth()->user()->name ?? 'System';
        
        $alarmSetting->update($validated);

        return redirect()->route('monitoring.alarm-settings.index')
            ->with('success', 'Alarm setting updated successfully.');
    }

    public function show($id)
    {
        $alarmSetting = AlarmSetting::findOrFail($id);
        
        // Check if user has access to this alarm setting
        if ($alarmSetting->site->company_id !== auth()->user()->company_id) {
            abort(403);
        }
        
        return response()->json($alarmSetting);
    }

    public function destroy($id)
    {
        $alarmSetting = AlarmSetting::findOrFail($id);
        $alarmSetting->delete();

        return redirect()->route('monitoring.alarm-settings.index')
            ->with('success', 'Alarm setting deleted successfully.');
    }
}
