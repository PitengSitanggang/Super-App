<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SettingService;
use Exception;

class SettingController extends Controller
{
    public function index(SettingService $settingService)
    {
        $settings = $settingService->getSettings();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request, SettingService $settingService)
    {
        if (!in_array(auth()->user()->role, ['superadmin', 'admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'app_name' => 'nullable|string|max:255',
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only('app_name');
        if ($request->hasFile('app_logo')) {
            $data['app_logo'] = $request->file('app_logo');
        }

        try {
            $settingService->updateSettings($data);
            return redirect()->back()->with('success', 'App settings updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating settings: ' . $e->getMessage());
        }
    }
}
