<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\user\Employee;
use App\Models\user\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Database\Seeders\user\AccountSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $listEmployee = Employee::all();
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_employee' => $listEmployee,
        ]);
    }

        /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return response()->json([
                'message' => 'Query successfully!',
                'status' => 200,
                'employee' => $employee,
            ]);
        } else {
            return response()->json([
                'message' => 'No ID Found!',
                'status' => 404,
                'employee' => $employee,
            ]);
        }
    }
    public function getEmployeeByAccountId()
    { 
        $user = auth()->user();
        // Kiểm tra token hợp lệ và người dùng đã đăng nhập
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {
            $employee = DB::table('employees')->where('account_id', '=', $user->id)->first();
           
            if ($employee) {
                $position = Position::find($employee->position_id);
                if ($position) {
                    $department = Department::find($position->department_id);
    
                    $data[] = [
                        "avatar"=>$user->avatar,
                        "username" => $user->username,
                        "email"=> $user->email,
                        "image"=> $employee->image,
                        "name" => $employee->full_name,
                        "gender" => $employee->gender,
                        "birthday" => $employee->birthday,
                        "CMND" => $employee->CMND,
                        "address" => $employee->address,
                        "phone" => $employee->phone,
                        "account_bank" => $employee->account_bank,
                        "name_bank" => $employee->name_bank,
                        "day_start" => $employee->day_start,
                        "position_name" => $position->position_name,
                        "department_name" => $department->department_name
                    ];
    
                return response()->json([
                    'message' => 'Query successfully!',
                    'status' => 200,
                    'customer' => $data,
                ], 200);
                } else {
                    return response()->json([
                        'message' => 'Data not found!',
                        'status' => 404,
                    ], 404);
                }
            }
        }
    }
    public function updateEmployeeByAccountId(Request $request)
    {
        $user = auth()->user();
        // Kiểm tra token hợp lệ và người dùng đã đăng nhập
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $data = Account::find($user->id);
        $employee = DB::table('employees')->where('account_id', '=', $user->id)->first();
        $employeeModel = Employee::find($employee->id);
        if($data && $employeeModel){
            if ($request->avatar) {
                $data->avatar = $request->avatar;
                $data->update();
            }
            if ($request->address) {
                $employeeModel->address = $request->address;
            }
            if ($request->phone) {
                $employeeModel->phone = $request->phone;
            }
            if ($request->account_bank) {
                $employeeModel->account_bank = $request->account_bank;
            }
            if ($request->name_bank) {
                $employeeModel->name_bank = $request->name_bank;
            }

            $employeeModel->update();
            return response()->json([
                'message' => 'Update successfully!',
                'status' => 200,
                'data' => $data,
                'customer' => $employeeModel,
            ], 200);
        }else{
            return response()->json([
                'message' => 'Data not found!',
                'status' => 404,
            ], 404);
        }

    }
    public function searchByParams($search)
    {
        if ($search) {
            $result  = Employee::where('full_name', 'LIKE', "%{$search}%")->get();

            if (count($result) > 0) {
                return response()->json([
                    
                    'status' => 200,
                    'data' => $result,
                ]);
            } else {
                return response()->json([
                    'message' => 'Not search',
                    'status' => 400,
                    'data' => $result,
                ]);
            }
        }
    }
    public function employeeFindID($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $position = Position::find($employee->position_id);
            if ($position) {
                $department = Department::find($position->department_id);

                $data[] = [
                    "id" => $employee->id,
                    "name" => $employee->full_name,
                    "gender" => $employee->gender,
                    "birthday" => $employee->birthday,
                    "image"=> $employee->image,
                    "CMND" => $employee->CMND,
                    "address" => $employee->address,
                    "phone" => $employee->phone,
                    "account_bank" => $employee->account_bank,
                    "name_bank" => $employee->name_bank,
                    "day_start" => $employee->day_start,
                    "day_quit" => $employee->day_quit,
                    "position_name" => $position->position_name,
                    "department_name" => $department->department_name
                ];

                return response()->json([
                    'message' => 'Query successfully!',
                    'status' => 200,
                    'data' => $data,
                ]);
            }
        } else {
            return response()->json([
                'message' => 'No ID Found',
                'status' => 404,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'full_name',
            'gender',
            'birthday',
            'CMND',
            'address',
            'image',
            'phone',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validate' => true,
                'message' => 'You need to enter employee',
            ]);
        }

        $employee = Employee::find($id);
        if ($employee) {
            $employee->full_name = $request->full_name;
            $employee->gender = $request->gender;
            $employee->birthday = $request->birthday;
            $employee->CMND = $request->CMND;
            $employee->address = $request->address;
            $employee->phone = $request->phone;
            $employee->image = $request->image;
            $employee->update();
            return response()->json([
                'message' => 'Employee Updated Successfully',
                'status' => 200,
                'employee' => $employee,
            ]);
        } else {
            return response()->json([
                'message' => 'No ID Found!',
                'status' => 404,
                'employee' => $employee,
            ]);
        }
    }
    public function quitEmployeeByID(Request $request, string $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'day_quit',
            'status',
            'enabled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validate' => true,
                'message' => 'You need to enter employee',
            ]);
        }

        $account_id = DB::table('employees')->where('id', '=', $id)->value('account_id');

        if ($account_id) {
            // $account = DB::table('accounts')->where('id', '=', $em)
            // $data[]= [
            // "day_quit"=>$employee->day_quit,
            // "status"=>$employee->status,
            // "enabled"=>$account->enabled
            // ];
            // if($data){
            // $data["status"] = $request-> status|'0';
            // $data["enabled"] = $request->enabled|'0';
            // // $data["day_quit"]->update();
            // $data["status"]->update();
            // $data["enabled"]->update();
            // $employee->full_name = $request->full_name;
            // $employee->gender = $request->gender;
            // $employee->birthday = $request->birthday;
            // $employee->CMND = $request->CMND;
            // $employee->address = $request->address;
            // $employee->phone = $request->phone;
            // $employee->update();

            $employee = DB::table('employees')->where('id', '=', $id)->update([
                'day_quit' => Carbon::now(),
                'status' => 0,
            ]);

            $account = DB::table('accounts')->where('id', '=', $account_id)->update([
                'enabled' => 0,
            ]);

            if ($employee && $account) {
                return response()->json([
                    'message' => 'Employee Updated Successfully',
                    'status' => 200,
                    'employee' => $id,
                    'account'=>$account_id,
                ]);
            } else {
                return response()->json([
                    'message' => 'Updated Failed!',
                    'status' => 400,
                    'employee' => $id,
                    'account'=>$account_id,
                ]);
            }
        } else {
            $employee = DB::table('employees')->where('id', '=', $id)->update([
                'day_quit' => Carbon::now(),
                'status' => 0,
            ]);
            if ($employee) {
                return response()->json([
                    'message' => 'Employee Updated Successfully',
                    'status' => 200,
                    'employee' => $id,
                   
                ]);
            } else {
                return response()->json([
                    'message' => 'Updated Failed!',
                    'status' => 400,
                    'employee' => $id,
                   
                ]);
            }
        }
    }
}
