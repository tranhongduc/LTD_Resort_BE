<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\user\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function update(Request $request) {
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
}
