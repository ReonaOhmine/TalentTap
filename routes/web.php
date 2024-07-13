<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\Auth\LoginController as AgentLoginController;
use App\Http\Controllers\Agent\Auth\SignupController as AgentSignupController;
use App\Http\Controllers\Employer\Auth\LoginController as EmployerLoginController;
use App\Http\Controllers\Employer\Auth\SignupController as EmployerSignupController;
use App\Http\Controllers\Employer\CustomerController;
use App\Http\Controllers\Agent\ProfileController as AgentProfileController;
use App\Http\Controllers\AgentCustomerController;
use App\Http\Controllers\Employer\ProfileController as EmployerProfileController;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\MessagesController;

// ウェルカムページ
Route::get('/', function () {
    return view('welcome');
});

// エージェント関連ルート
Route::get('agent/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth:agent')
    ->name('agent.dashboard');

Route::get('agent/signup', [AgentSignupController::class, 'create'])->name('agent.signup');
Route::post('agent/signup', [AgentSignupController::class, 'store']);
Route::get('agent/login', [AgentLoginController::class, 'create'])->name('agent.login');
Route::post('agent/login', [AgentLoginController::class, 'store']);
Route::get('agent/profile', [AgentProfileController::class, 'show'])
    ->middleware('auth:agent')
    ->name('agent.profile');
Route::get('agent/profile/edit', [AgentProfileController::class, 'edit'])
    ->middleware('auth:agent')
    ->name('agent.profile.edit');
Route::patch('agent/profile', [AgentProfileController::class, 'update'])
    ->middleware('auth:agent')
    ->name('agent.profile.update');

Route::get('agent/customer/index', [AgentCustomerController::class, 'index'])->name('agent.customer.index');
Route::get('agent/customer/create', [AgentCustomerController::class, 'create'])->name('agent.customer.create');
Route::post('agent/customer/store', [AgentCustomerController::class, 'store'])->name('agent.customer.store');
Route::get('agent/customer/edit/{id}', [AgentCustomerController::class, 'edit'])->name('agent.customer.edit');
Route::patch('agent/customer/update/{id}', [AgentCustomerController::class, 'update'])->name('agent.customer.update');

Route::get('agent/messages', [MessagesController::class, 'agentIndex'])
    ->middleware('auth:agent')
    ->name('agent.messages.index');
Route::post('agent/messages', [MessagesController::class, 'agentSendMessage'])
    ->middleware('auth:agent')
    ->name('agent.messages.send');

// 利用企業関連ルート
Route::get('employer/dashboard', function () {
    return view('employer.dashboard');
})->middleware('auth:employer')->name('employer.dashboard');

Route::get('employer/signup', [EmployerSignupController::class, 'create'])->name('employer.signup');
Route::post('employer/signup', [EmployerSignupController::class, 'store']);
Route::get('employer/login', [EmployerLoginController::class, 'create'])->name('employer.login');
Route::post('employer/login', [EmployerLoginController::class, 'store']);
Route::post('employer/logout', [EmployerLoginController::class, 'logout'])->name('employer.logout');
Route::get('employer/profile', [EmployerProfileController::class, 'show'])
    ->middleware('auth:employer')
    ->name('employer.profile');
Route::get('employer/profile/edit', [EmployerProfileController::class, 'edit'])
    ->middleware('auth:employer')
    ->name('employer.profile.edit');
Route::patch('employer/profile', [EmployerProfileController::class, 'update'])
    ->middleware('auth:employer')
    ->name('employer.profile.update');

Route::get('employer/customer/search', function () {
    return view('employer.customer.search');
})->name('employer.customer.search');
Route::get('employer/customer/data', [CustomerController::class, 'getCustomerData'])->name('employer.customer.data');

// get-candidate ルートの修正（プレフィックスなし）
Route::get('api/get-candidate/{id}', [AgentCustomerController::class, 'getCandidate']);

Route::get('employer/messages', [MessagesController::class, 'employerIndex'])
    ->middleware('auth:employer')
    ->name('employer.messages.index');
Route::post('employer/messages', [MessagesController::class, 'employerSendMessage'])
    ->middleware('auth:employer')
    ->name('employer.messages.send');

// ログインルート
// Route::get('login', function () {
//     return view('auth.login');
// })->name('login');

// イベント送信ルート
// Route::get('/send', function () {
//     broadcast(new ExampleEvent('Hello Pusher!'));
//     return 'Event has been sent!';
// });
