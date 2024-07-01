<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $employer = Auth::guard('employer')->user();
        return view('employer.profile.show', compact('employer'));
    }

    public function edit()
    {
        $employer = Auth::guard('employer')->user();
        return view('employer.profile.edit', compact('employer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'tel' => 'required|string|max:20',
            'hp_url' => 'nullable|url|max:255',
            'logo_image' => 'nullable|image|max:2048',
        ]);

        $employer = Auth::guard('employer')->user();
        $employer->update($request->only('company_name', 'position', 'name', 'email', 'tel', 'hp_url'));

        if ($request->hasFile('logo_image')) {
            $path = $request->file('logo_image')->store('logos', 'public');
            $employer->logo_image = $path;
            $employer->save();
        }

        return redirect()->route('employer.profile')->with('success', 'Profile updated successfully.');
    }
}
