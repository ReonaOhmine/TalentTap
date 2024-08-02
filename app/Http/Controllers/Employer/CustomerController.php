<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerUser;

class CustomerController extends Controller
{
    public function getCustomerData()
    {
        // id の降順でデータを取得するように変更
        $customers = CustomerUser::orderBy('id', 'desc')->get();

        return response()->json($customers);
    }
}