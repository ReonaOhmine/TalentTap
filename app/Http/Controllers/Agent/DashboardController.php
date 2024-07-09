<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agent;

class DashboardController extends Controller
{
    public function index()
    {
        // ログイン中のエージェントの情報を取得
        $agent = Auth::guard('agent')->user();

        // 必要に応じてエージェントに関連するデータを取得
        // 例: $customers = $agent->customers;

        // ビューにデータを渡す
        return view('agent.dashboard', [
            'agent' => $agent,
            // 'customers' => $customers,
        ]);
    }
}
