<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerUser;

class CustomerController extends Controller
{
    public function getCustomerData()
    {
        $customers = CustomerUser::all();

        return response()->json($customers);
    }
};
