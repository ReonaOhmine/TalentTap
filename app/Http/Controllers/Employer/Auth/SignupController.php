<?php

namespace App\Http\Controllers\Employer\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmployerUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    // 利用企業ユーザー登録ページを表示
    public function create()
    {
        return view('employer.signup');
    }

    // 利用企業ユーザー登録処理
    public function store(Request $request)
    {
        Log::info('Signup request received', $request->all()); // デバッグログ追加

        // リクエストデータをバリデートする
        $validator = Validator::make($request->all(), [
            'company_name' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employer_users'],
            'tel' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // バリデーションが失敗した場合、エラーメッセージとともに登録ページにリダイレクト
        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray()); // デバッグログ追加

            return redirect()->route('employer.signup')
                ->withErrors($validator)
                ->withInput();
        }

        // バリデーションを通過したデータを取得
        $validated = $validator->validated();
        // パスワードをハッシュ化
        $validated['password'] = Hash::make($validated['password']);

        // 新しい利用企業ユーザーをデータベースに保存
        $employer = EmployerUser::create($validated);

        Log::info('User registered successfully', ['user' => $employer]); // デバッグログ追加

        // 会員登録完了後、ログインページにリダイレクト
        return redirect()->route('employer.login')->with('status', '会員登録が完了しました。ログインしましょう');
    }
}
