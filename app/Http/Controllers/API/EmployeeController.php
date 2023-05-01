<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\Account;

class EmployeeController extends Controller
{
    public function index()
    {
        $listAccount = Account::all();
        return response()->json([
            'message' => 'Query successfully!',
            'status'=> 200,
            'list_accounts' => $listAccount
        ]);
    }

}
