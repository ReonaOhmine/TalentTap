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
            'status' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string|max:255',
            'desired_salary_min' => 'nullable|integer',
            'desired_salary_max' => 'nullable|integer',
            'catch_copy' => 'nullable|string|max:60',
            'career_description' => 'nullable|string|max:250',
            'num_companies_worked' => 'nullable|integer',
            'work_preference' => 'nullable|array',
            'skill_distribution_1' => 'nullable|string|max:255',
            'skill_distribution_2' => 'nullable|string|max:255',
            'skill_distribution_3' => 'nullable|string|max:255',
            'skill_comment_1' => 'nullable|string|max:100',
            'skill_comment_2' => 'nullable|string|max:100',
            'skill_comment_3' => 'nullable|string|max:100',
            'notable_achievements' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'initial' => 'nullable|string|max:255'
        ]);

        $data = $request->all();
        $data['work_preference'] = json_encode($request->input('work_preference', []));
        $data['status'] = $request->input('status', 'pending');

        CustomerUser::create($data);

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
            'status' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string|max:255',
            'desired_salary_min' => 'nullable|integer',
            'desired_salary_max' => 'nullable|integer',
            'catch_copy' => 'nullable|string|max:60',
            'career_description' => 'nullable|string|max:250',
            'num_companies_worked' => 'nullable|integer',
            'work_preference' => 'nullable|array',
            'skill_distribution_1' => 'nullable|string|max:255',
            'skill_distribution_2' => 'nullable|string|max:255',
            'skill_distribution_3' => 'nullable|string|max:255',
            'skill_comment_1' => 'nullable|string|max:100',
            'skill_comment_2' => 'nullable|string|max:100',
            'skill_comment_3' => 'nullable|string|max:100',
            'notable_achievements' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'initial' => 'nullable|string|max:255'


        ]);

        $data = $request->all();
        $data['work_preference'] = json_encode($request->input('work_preference', []));
        $data['status'] = $request->input('status', 'pending');

        $user = CustomerUser::findOrFail($id);
        $user->update($data);

        return redirect()->route('agent.customer.index');
    }
}
