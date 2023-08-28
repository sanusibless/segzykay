<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function index()
    {   
       $settings = Settings::first();

        return view('admin.settings', compact('settings'));
    }

    public function save(Request $request) 
    {
        if($request->has('start')) {
             $data = $request->validate([
                'start' => 'required',
                'start_date' => "required|date|after:today",
                'end_date' => "required|date|after:start_date",
                'number_of_contestant' => "required|integer",
                'min_age' => "required|integer|min:18"
            ]);

            Settings::Create($data);

            return back();
        }

            $settings =  Settings::first();

            if($settings != null) {
                $settings->delete();
            }

            return back()->with('success', "Face of Segzykay is successfully closed!");
    }
}
