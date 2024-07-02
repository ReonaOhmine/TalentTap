<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agent; // Agentモデルのインポート

class ProfileController extends Controller
{
public function show()
{
$agent = Auth::guard('agent')->user();
return view('agent.profile.show', compact('agent'));
}

public function edit()
{
$agent = Auth::guard('agent')->user();
return view('agent.profile.edit', compact('agent'));
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

$agent = Auth::guard('agent')->user();
if (!$agent) {
return redirect()->route('agent.login')->withErrors('You must be logged in to update this page.');
}

$agent->company_name = $request->input('company_name');
$agent->position = $request->input('position');
$agent->name = $request->input('name');
$agent->email = $request->input('email');
$agent->tel = $request->input('tel');
$agent->hp_url = $request->input('hp_url');

if ($request->hasFile('logo_image')) {
$path = $request->file('logo_image')->store('logos', 'public');
$agent->logo_image = $path;
}

$agent->save();

return redirect()->route('agent.profile')->with('success', 'Profile updated successfully.');
}
}