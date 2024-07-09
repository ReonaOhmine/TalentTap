<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    // エージェントユーザー登録ページを表示
    public function create()
    {
        return view('agent.signup');
    }

    // エージェントユーザー登録処理
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:agents'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('agent.signup')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $validated['password'] = Hash::make($validated['password']); // パスワードのハッシュ化

        // デバッグログの追加
        Log::info('Request Data:', $request->all());
        Log::info('Validated Data:', $validated);

        $agent = Agent::create($validated);

        return redirect()->route('agent.login')->with('status', '会員登録が完了しました。ログインしましょう');
    }
}
