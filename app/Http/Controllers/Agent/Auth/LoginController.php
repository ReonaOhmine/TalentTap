<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // ログインページの表示
    public function create()
    {
        return view('agent.login');
    }

    // ログイン処理
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('agent.login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('agent')->attempt($credentials, $request->filled('remember'))) {
            // 認証成功
            return redirect()->intended('/agent/dashboard')->with('status', 'ログインに成功しました。');
        }

        // 認証失敗
        return redirect()->route('agent.login')->with('status', 'メールアドレスまたはパスワードが違います。');
    }
}
