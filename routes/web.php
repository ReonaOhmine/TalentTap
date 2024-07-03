<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\Auth\LoginController as AgentLoginController;
use App\Http\Controllers\Agent\Auth\SignupController as AgentSignupController;
use App\Http\Controllers\Employer\Auth\LoginController as EmployerLoginController;
use App\Http\Controllers\Employer\Auth\SignupController as EmployerSignupController;
use App\Http\Controllers\AgentCustomerController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\Employer\CustomerController;
use App\Http\Controllers\Agent\ProfileController as AgentProfileController;
use App\Http\Controllers\Employer\ProfileController as EmployerProfileController;

// ウェルカムページ
Route::get('/', function () {
    return view('welcome');
});

//*************エージェント関連*************//
// エージェントダッシュボードページの表示
Route::get('/agent/dashboard', function () {
    return view('agent.dashboard');
})->middleware('auth:agent')->name('agent.dashboard');

// エージェント登録ページの表示
Route::get('/agent/signup', [AgentSignupController::class, 'create'])->name('agent.signup');
// エージェントの登録処理
Route::post('/agent/signup', [AgentSignupController::class, 'store']);

// エージェントログインページの表示
Route::get('/agent/login', [AgentLoginController::class, 'create'])->name('agent.login');
// エージェントログイン処理
Route::post('/agent/login', [AgentLoginController::class, 'store']);

// エージェントのマイページ表示
Route::middleware('auth:agent')->group(function () {
    Route::get('/agent/profile', [AgentProfileController::class, 'show'])->name('agent.profile');
    Route::get('/agent/profile/edit', [AgentProfileController::class, 'edit'])->name('agent.profile.edit');
    Route::patch('/agent/profile', [AgentProfileController::class, 'update'])->name('agent.profile.update');
});

// 支援中ユーザーの表示
Route::get('/agent/customer/index', [AgentCustomerController::class, 'index'])->name('agent.customer.index');

// 支援中ユーザーの登録画面の表示
Route::get('/agent/customer/create', [AgentCustomerController::class, 'create'])->name('agent.customer.create');
// 支援中ユーザーの登録処理
Route::post('/agent/customer/store', [AgentCustomerController::class, 'store'])->name('agent.customer.store');

// 支援中ユーザーの編集画面の表示
Route::get('/agent/customer/edit/{id}', [AgentCustomerController::class, 'edit'])->name('agent.customer.edit');
// 支援中ユーザーの更新処理
Route::patch('/agent/customer/update/{id}', [AgentCustomerController::class, 'update'])->name('agent.customer.update');

// メッセージページの表示
Route::get('/agent/message', [MessagesController::class, 'show'])->name('agent.message');

//*************利用企業関連*************//
// 利用企業ダッシュボードページの表示
Route::get('/employer/dashboard', function () {
    return view('employer.dashboard');
})->middleware('auth:employer')->name('employer.dashboard');

// 利用企業登録ページの表示
Route::get('/employer/signup', [EmployerSignupController::class, 'create'])->name('employer.signup');
// 利用企業の登録処理
Route::post('/employer/signup', [EmployerSignupController::class, 'store']);

// 利用企業ログインページの表示
Route::get('/employer/login', [EmployerLoginController::class, 'create'])->name('employer.login');
// 利用企業ログイン処理
Route::post('/employer/login', [EmployerLoginController::class, 'store']);
// 利用企業ログインアウト処理
Route::post('/employer/logout', [EmployerLoginController::class, 'logout'])->name('employer.logout');

// 利用企業のマイページ表示
Route::middleware('auth:employer')->group(function () {
    Route::get('/employer/profile', [EmployerProfileController::class, 'show'])->name('employer.profile');
    Route::get('/employer/profile/edit', [EmployerProfileController::class, 'edit'])->name('employer.profile.edit');
    Route::patch('/employer/profile', [EmployerProfileController::class, 'update'])->name('employer.profile.update');
});

// 利用企業候補者検索ページの表示
Route::get('/employer/customer/search', function () {
    return view('employer.customer.search');
});

// 候補者データを取得するためのルートを追加
Route::get('/employer/customer/data', [CustomerController::class, 'getCustomerData'])->name('employer.customer.data');
Route::get('/api/get-candidate/{id}', [AgentCustomerController::class, 'getCandidate']);
