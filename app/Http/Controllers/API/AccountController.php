<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\Account;

class AccountController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find($str) {
        $accounts = Account::where('username', 'like', '%' . $str . '%')->get();
        return response()->json([
            'message' => 'Query successfully!',
            'status'=> 200,
            'accounts' => $accounts
        ]);
    }

}
