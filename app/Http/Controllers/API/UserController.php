<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\Account;

class UserController extends Controller
{
    public function index()
    {
        $listAccount = Account::all();
        return response()->json([
            'status'=> 200,
            'data' => $listAccount
        ]);
    }

}
