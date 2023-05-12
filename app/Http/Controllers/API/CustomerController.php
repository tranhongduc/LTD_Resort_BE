<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ranking;
use App\Models\user\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\user\Account;
use Illuminate\Support\Facades\Hash;
class CustomerController extends Controller
{
    public function index()
    {
        $list_customers = Customer::all();
      
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_customers' => $list_customers,
        ], 200);
    }
  
    public function show($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return response()->json([
                'message' => 'Query successfully!',
                'status' => 200,
                'customer' => $customer,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found!',
                'status' => 404,
                'customer' => $customer,
            ], 404);
        }
    }

    public function getCustomerByAccountId($account_id) {
        $customer = DB::table('customers')->where('account_id', '=', $account_id)->first();

        if ($customer) {
            return response()->json([
                'message' => 'Query successfully!',
                'status' => 200,
                'customer' => $customer,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found!',
                'status' => 404,
                'customer' => $customer,
            ], 404);
        }
    }

    public function getRankingNameByAccountId($id) {
        $customer_id = DB::table('customers')->where('account_id', '=', $id)->value('id');
        $ranking_id = DB::table('customers')->where('id', '=', $customer_id)->value('ranking_id');
        $ranking_name = DB::table('rankings')->where('id', '=', $ranking_id)->value('ranking_name');

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'ranking_name' => $ranking_name,
        ], 200);
    }

    public function updateByAccountId(Request $request) {
        $customer_id = DB::table('customers')->where('account_id', '=', $request->account_id)->value('id');

        // Validate the request data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required',
            'birth_date' => 'required',
            'id_card' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $customer = DB::table('customers')->where('id', '=', $customer_id)->update([
            'full_name' => $validatedData['full_name'],
            'gender' => $validatedData['gender'],
            'birthday' => $validatedData['birth_date'],
            'CMND' => $validatedData['id_card'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
        ]);

        if ($customer) {
            return response()->json([
                'message' => 'Update successfully!',
                'status' => 200,
                'customer' => $customer,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Update failed!',
                'status' => 400,
                'customer' => $customer,
            ], 400);
        }
    }

    public function searchByParams($search)
    {
        if($search){
            $result  = Customer::where('full_name','LIKE',"%{$search}%")->get();
        
            if(count($result) > 0){
                return response()->json([
                    'message' => 'Query successfully!'
                    'status' => 200,
                    'data' => $result
                ]);
            } else {
                return response()->json([
                    'message' => 'Data not found!'
                    'status' => 400,
                    'data' => $result
                ]);
            }
        }
    }
  
    public function customerFindID($id)
    {
        $customer = Customer::find($id);
      
        if($customer){
            $ranking = Ranking::find($customer->ranking_id);
            $data[] = [
                "id" => $customer->id,
                "name" => $customer->full_name,
                "gender" => $customer->gender,
                "birthday" => $customer->birthday,
                "CMND" => $customer->CMND,
                "address" => $customer->address,
                "phone" => $customer->phone,
                "ranking_point" => $customer->ranking_point,
                "ranking_name" => $ranking->ranking_name,
                "discount" => $ranking->discount
            ];
            return response()->json([
                'message' => 'Query successfully!',
                'status' => 200,
                'data' => $data
            ]);
        } else {
            return response()->json([
              'message' => 'No ID Found',
              'status' => 404,
              'data' => $data
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
      
        $validator = Validator::make($input, [
            'full_name',
            'gender' ,
            'birthday',
            'CMND',
            'address',
            'phone',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validate' => true,
                'message' => 'You need to enter customer',
            ]);
        }

        $customer = Customer::find($id);
        if ($customer) {
            $customer->full_name = $request->full_name;
            $customer->gender = $request->gender;
            $customer->birthday = $request->birthday;
            $customer->CMND = $request->CMND;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            $customer->update();
            return response()->json([
                'status' => 200,
                'message' => 'Update successfully!',
                'customer' => $customer,
            ]);
        } else {
            return response()->json([
                'message' => 'Update failed!',
                'status' => 404,
                'customer' => $customer,
            ]);
         }
    }
  }
}
