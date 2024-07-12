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
use App\Events\ExampleEvent;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\MessagesController;

// ウェルカムページ
Route::get('/', function () {
    return view('welcome');
});

//************* エージェント関連 *************//
Route::prefix('agent')->name('agent.')->group(function () {
    // ダッシュボード
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('auth:agent')
        ->name('dashboard');

    // 登録関連
    Route::get('signup', [AgentSignupController::class, 'create'])->name('signup');
    Route::post('signup', [AgentSignupController::class, 'store']);

    // ログイン関連
    Route::get('login', [AgentLoginController::class, 'create'])->name('login');
    Route::post('login', [AgentLoginController::class, 'store']);

    // マイページ関連
    Route::middleware('auth:agent')->group(function () {
        Route::get('profile', [AgentProfileController::class, 'show'])->name('profile');
        Route::get('profile/edit', [AgentProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [AgentProfileController::class, 'update'])->name('profile.update');
    });

    // 支援中ユーザー関連
    Route::get('customer/index', [AgentCustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/create', [AgentCustomerController::class, 'create'])->name('customer.create');
    Route::post('customer/store', [AgentCustomerController::class, 'store'])->name('customer.store');
    Route::get('customer/edit/{id}', [AgentCustomerController::class, 'edit'])->name('customer.edit');
    Route::patch('customer/update/{id}', [AgentCustomerController::class, 'update'])->name('customer.update');

    // メッセージ関連
    Route::middleware('auth:agent')->group(function () {
        Route::get('messages', [MessagesController::class, 'agentIndex'])->name('messages.index');
        Route::post('messages', [MessagesController::class, 'agentSendMessage'])->name('messages.send');
    });
});

//************* 利用企業関連 *************//
Route::prefix('employer')->name('employer.')->group(function () {
    // ダッシュボード
    Route::get('dashboard', function () {
        return view('employer.dashboard');
    })->middleware('auth:employer')->name('dashboard');

    // 登録関連
    Route::get('signup', [EmployerSignupController::class, 'create'])->name('signup');
    Route::post('signup', [EmployerSignupController::class, 'store']);

    // ログイン関連
    Route::get('login', [EmployerLoginController::class, 'create'])->name('login');
    Route::post('login', [EmployerLoginController::class, 'store']);
    Route::post('logout', [EmployerLoginController::class, 'logout'])->name('logout');

    // マイページ関連
    Route::middleware('auth:employer')->group(function () {
        Route::get('profile', [EmployerProfileController::class, 'show'])->name('profile');
        Route::get('profile/edit', [EmployerProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [EmployerProfileController::class, 'update'])->name('profile.update');
    });

    // 候補者検索関連
    Route::get('customer/search', function () {
        return view('employer.customer.search');
    })->name('customer.search');
    Route::get('customer/data', [CustomerController::class, 'getCustomerData'])->name('customer.data');
    Route::get('/api/get-candidate/{id}', [AgentCustomerController::class, 'getCandidate']);

    // メッセージ関連
    Route::middleware('auth:employer')->group(function () {
        Route::get('messages', [MessagesController::class, 'employerIndex'])->name('messages.index');
        Route::post('messages', [MessagesController::class, 'employerSendMessage'])->name('messages.send');
    });
});

// ログインルート
// Route::get('login', function () {
//     return view('auth.login');
// })->name('login');

// イベント送信ルート
// Route::get('/send', function () {
//     broadcast(new ExampleEvent('Hello Pusher!'));
//     return 'Event has been sent!';
// });
