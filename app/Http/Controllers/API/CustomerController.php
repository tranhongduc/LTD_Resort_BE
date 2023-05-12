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
        $listCustomer = Customer::all();
        return response()->json([
            'message' => 'Query successfully!',
            'status'=> 200,
            'list_customer' => $listCustomer
        ]);
    }
    public function searchByParams($search)
    {
        if($search){
            $result  = Customer::where('full_name','LIKE',"%{$search}%")->get();
        
            if(count($result) > 0){
                return response()->json([
                    'status' => 200,
                    'data' =>$result
                ]);
            }
            else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Not search'
                ]);
        
            }
        }
    }
    public function customerFindID($id)
    {
        $customer= Customer::find($id);
        if($customer){
            $ranking = Ranking::find($customer->ranking_id);
            $data[]=[
                "id"=> $customer->id,
                "name" => $customer->full_name,
                "gender" => $customer->gender,
                "birthday"=>$customer->birthday,
                "CMND"=>$customer->CMND,
                "address"=>$customer->address,
                "phone"=>$customer->phone,
                "ranking_point"=>$customer->ranking_point,
                "ranking_name"=>$ranking->ranking_name,
                "discount"=>$ranking->discount
                 
            ];
            return response()->json([
                'status'=>200,
                'message'=> 'OK',
                'data'=>$data
            ]);

        }else{
            return response()->json([
            'status'=>404,
            'message'=>'No ID Found',
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request, $id)
    // {
    //     $customer = new Customer;
    //     $customer->full_name = $request->input('full_name');
    //     $customer->gendere = $request->input('gendere');
    //     $customer->birthay = $request->input('birthay');
    //     $customer->CMND = $request->input('CMND');
    //     $customer->address = $request->input('address');
    //     $customer->phone = $request->input('phone');
    //     $customer->save();
    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'Question Added Successfully',
    //     ]);
    // }
    public function registerCustomer(Request $request){
        // validate form
        $validator = Validator::make($request->all(),[ 
            'username'=> 'required',
            'email'=>'required|email|unique:accounts',
            'password'=>'required|min:6',
            'confirm_password'=> 'required|same:password',
        ]);

        if($validator->fails()){
            $response =[
                'status_code' => 400,
                'message' => $validator->errors(),
            ];
            return response()->json($response,400);
        }

        // Create new account
        $account = Account::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'enabled' => $request->enabled|'1',
            'role_id' => $request->role_id|'3'
        ]);
        if($account){
            $account->customer()->create([
            'account_id'=>$account->id,
            'ranking_point'=>$request->ranking_point|'0'
            ]);
        }

        // Get a JWT
        // $token = Customer::login($account);

        return response()->json([
            'status_code' => 201,
            'message' => 'User created successfully!',
            'user' => $account,
            // 'authorization' => [
            //     'token' => $token,
            //     'type' => 'bearer',
            // ]
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'full_name' => 'required|string',
    //         'gender' => 'required'|'Nam'or 'Nữ',
    //         'birthay'=>'required'|date('y-m-d'),
    //         'CMND'=>'required|number',
    //         'address'=>'required|string',
    //         'phone'=>'required|number',
            

    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'validate' => true,
    //             'message' => 'You need to enter customer',
    //         ]);
    //     }
    //     $customer = new Customer;
    //     $customer->full_name = $request->input('full_name');
    //     $customer->gendere = $request->input('gendere');
    //     $customer->birthay = $request->input('birthay');
    //     $customer->CMND = $request->input('CMND');
    //     $customer->address = $request->input('address');
    //     $customer->phone = $request->input('phone');
    //     $customer->save();
    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'Question Added Successfully',
    //     ]);
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if($customer){
            return response()->json([
                'status'=>200,
                'message'=> 'OK',
                'customer'=>$customer,
            ]);

        }else{
            return response()->json([
            'status'=>404,
            'message'=>'No ID Found',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $Customer = Customer::find($id);
        return response()->json([
            'status' => 200,
            'question' => $Customer,
        ]);
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
        //
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
                'message' => 'Question Updated Successfully',
                // 're' => $customer,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No ID Found',
            ]);
         }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }
  }
}
