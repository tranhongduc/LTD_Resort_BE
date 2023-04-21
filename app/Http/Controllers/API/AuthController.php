<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        // validation
        $validator = Validator::make($request->all(),[ 
            'name'=> 'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'c_password'=> 'required|same:password',
        ]);
        if($validator->fails()){
            $response =[
                'success'=>false,
                'mesage'=>$validator->errors()

            ];
            return response()->json($response,400);
        }
        $input =$request->all();
        $input['password']=bcrypt($input['password']);
        $user=User::create($input);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'success'=>true,
            'message'=>'User register successfully',
            'accessToken' => $accessToken
        ]);

    }
    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user =Auth::user();
            $success['token']=$user->createToken('MyApp')->plainTextToken;
            $success['name']=$user->name;
            $response=[
                'success'=>true,
                'data'=>$success,
                'message'=>'User login successfully'
            ];
            return response()->json($response,200);
        }else{
            $reaponse=[
                'success'=>false,
                'message'=>'Unauthorised'

            ];
            return response()->json($response);
        }
    }
}
