<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\Account;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $listAccount = Account::all();
        return response()->json([
            'message' => 'Query successfully!',
            'status'=> 200,
            'list_accounts' => $listAccount
        ], 200);
    }

    public function show($id)
    {
        $account = Account::find($id);
        return response()->json([
            'message' => 'Query successfully!',
            'status'=> 200,
            'account' => $account
        ], 200);
    }

    public function searchByUsername($username) {
        $accounts = Account::where('username', 'like', '%' . $username . '%')->get();

        if (count($accounts) == 0) {
            return response()->json([
                'message' => 'Data not found!',
                'status'=> 404,
                'accounts' => $accounts
            ], 404);
        } else {
            return response()->json([
                'message' => 'Query successfully!',
                'status'=> 200,
                'accounts' => $accounts
            ], 200);
        }
    }

    public function updateAvatar(Request $request, $id) {
        // Validate the request data
        $validatedData = $request->validate([
            'avatar_url' => 'required|string|max:255',
        ]);

        $result = DB::table('accounts')->where('id', '=', $id)->update([
            'avatar' => $validatedData['avatar_url'],
        ]);

        if ($result) {
            return response()->json([
                'message' => 'Update avatar successfully!',
                'status' => 200,
                'account' => $result,
            ], 200);
            
        } else {
            return response()->json([
                'message' => 'Update avatar failed!',
                'status' => 400,
                'account' => $result,
            ], 400);
        }
    }
}
