<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerUser;
use Illuminate\Support\Facades\DB;

class AgentCustomerController extends Controller
{
    public function index()
    {
        $users = CustomerUser::all();
        return view('agent.customer.index', compact('users'));
    }

    public function getCandidate($id)
    {
        $candidate = DB::table('customer_users')->where('id', $id)->first();
        return response()->json($candidate);
    }

    public function create()
    {
        return view('agent.customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'matching' => 'required|integer|min:0|max:5',
            'created_at' => 'required|date',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string|max:255',
            'desired_salary_min' => 'nullable|integer',
            'desired_salary_max' => 'nullable|integer',
            'catch_copy' => 'nullable|string|max:60',
            'career_description' => 'nullable|string|max:250',
            'num_companies_worked' => 'nullable|integer',
            'skill_distribution' => 'nullable|json',
            'notable_achievements' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'initial' => 'nullable|string' // 新しいフィールドのバリデーション
        ]);

        CustomerUser::create($request->all());

        return redirect()->route('agent.customer.index');
    }

    public function edit($id)
    {
        $user = CustomerUser::findOrFail($id);
        return view('agent.customer.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'matching' => 'required|integer|min:0|max:5',
            'created_at' => 'required|date',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string|max:255',
            'desired_salary_min' => 'nullable|integer',
            'desired_salary_max' => 'nullable|integer',
            'catch_copy' => 'nullable|string|max:60',
            'career_description' => 'nullable|string|max:250',
            'num_companies_worked' => 'nullable|integer',
            'skill_distribution' => 'nullable|json',
            'notable_achievements' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'initial' => 'nullable|string' // 新しいフィールドのバリデーション
        ]);

        $user = CustomerUser::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('agent.customer.index');
    }
}
