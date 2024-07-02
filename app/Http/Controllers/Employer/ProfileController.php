<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployerUser; // EmployerUserモデルのインポート

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
            'company_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'tel' => 'nullable|string|max:20',
            'hp_url' => 'nullable|url|max:255',
            'logo_image' => 'nullable|image|max:2048',
        ]);

        $employer = Auth::guard('employer')->user();
        if (!$employer) {
            return redirect()->route('employer.login')->withErrors('You must be logged in to update this page.');
        }

        // 更新するプロパティを一つずつ設定
        $employer->company_name = $request->input('company_name');
        $employer->position = $request->input('position');
        $employer->name = $request->input('name');
        $employer->email = $request->input('email');
        $employer->tel = $request->input('tel');
        $employer->hp_url = $request->input('hp_url');

        if ($request->hasFile('logo_image')) {
            $path = $request->file('logo_image')->store('logos', 'public');
            $employer->logo_image = $path;
        }

        $employer->save();

        return redirect()->route('employer.profile')->with('success', 'Profile updated successfully.');
    }
}
