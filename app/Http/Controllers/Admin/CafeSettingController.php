<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CafeSetting;
use Illuminate\Http\Request;

class CafeSettingController extends Controller
{
    public function edit()
    {
        $setting = CafeSetting::firstOrCreate(
            [],
            ['cafe_name' => 'LUMA']
        );
        

        return view('admin.cafe-settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'cafe_name'    => ['required', 'string', 'max:100'],
            'tagline'      => ['nullable', 'string', 'max:255'],
            'address'      => ['nullable', 'string', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:30'],
            'whatsapp'     => ['nullable', 'string', 'max:30'],
            'instagram'    => ['nullable', 'string', 'max:100'],
            'opening_hours'=> ['nullable', 'string', 'max:255'],
            'maps_url'     => ['nullable', 'url', 'max:500'],
        ]);

        $setting = CafeSetting::firstOrCreate(
            [],
            ['cafe_name' => 'LUMA']
        );

        $setting->update($validated);

        return back()->with(
            'success',
            'Cafe information updated successfully.'
        );
    }
}