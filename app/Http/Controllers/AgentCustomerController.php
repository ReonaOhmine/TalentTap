<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerUser;

class AgentCustomerController extends Controller
{
    public function index()
    {
        $users = CustomerUser::all();
        return view('agent.customer.index', compact('users'));
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
        ]);

        $user = CustomerUser::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('agent.customer.index');
    }
}
