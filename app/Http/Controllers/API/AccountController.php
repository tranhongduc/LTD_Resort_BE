<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // public function index()
    // {
    //     $listAccount = Account::all();
    //     return response()->json([
    //         'message' => 'Query successfully!',
    //         'status'=> 200,
    //         'list_accounts' => $listAccount
    //     ], 200);
    // }

    // public function show($id)
    // {
    //     $account = Account::find($id);
    //     return response()->json([
    //         'message' => 'Query successfully!',
    //         'status'=> 200,
    //         'account' => $account
    //     ], 200);
    // }

    // public function searchByUsername($username) {
    //     $accounts = Account::where('username', 'like', '%' . $username . '%')->get();
    //     // $accounts = Account::where('')

    //     if (count($accounts) == 0) {
    //         return response()->json([
    //             'message' => 'Data not found!',
    //             'status'=> 404,
    //             'accounts' => $accounts
    //         ], 404);
    //     } else {
    //         return response()->json([
    //             'message' => 'Query successfully!',
    //             'status'=> 200,
    //             'accounts' => $accounts
    //         ], 200);
    //     }
    // }

    public function changePassword(Request $request)
    {
        $user = auth()->user();
        // Kiểm tra token hợp lệ và người dùng đã đăng nhập
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $validator = Validator::make($request->all(),[ 
            'current_password'=>'required',
            'new_password'=>'required|min:6',
            'confirm_password'=> 'required|same:new_password',
        ]);

        if($validator->fails()){
            $response =[
                'status_code' => 400,
                'message' => $validator->errors(),
            ];
            return response()->json($response,400);
        }
        // Kiểm tra và cập nhật dữ liệu chỉ khi người dùng đúng là chủ sở hữu
        $data = Account::findOrFail($user->id);
        $currentPassword = $request->current_password;
        $newPassword = $request->new_password;
 // Cập nhật mật khẩu mới cho người dùng
        if($data){
             // Kiểm tra mật khẩu hiện tại của người dùng
                if (!Hash::check($currentPassword, $data->password)) {
                    return response()->json(['message' => 'Password failed!'], 401);
                }
                    $data->password = Hash::make($newPassword);
                    $data->save();
                    if ($data) {
                        return response()->json([
                            'message' => 'Change password successfully',
                            'status' => 200,
                            'account' => $data,
                        ], 200);
                    } else {
                        return response()->json([
                            'message' => 'Update password failed!',
                            'status' => 400,
                            'account' => $data,
                        ], 400);
                    }
                
           
            }
        
        }
    

    
}
