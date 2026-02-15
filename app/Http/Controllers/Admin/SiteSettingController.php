<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            $setting = SiteSetting::where('key', $key)->first();
            if ($setting) {
                if ($setting->type === 'image') {
                    if ($request->hasFile($key)) {
                        $path = $request->file($key)->store('settings', 'public');
                        $setting->update(['value' => $path]);
                    }
                } else {
                    $setting->update(['value' => $value]);
                }
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
