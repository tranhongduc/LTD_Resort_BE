<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\user\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'CMND' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'account_bank' => 'required',
            'name_bank' => 'required',
            'position_id' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'status_code' => 400,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }

        $employee = Employee::create([
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'CMND' => $request->CMND,
            'address' => $request->address,
            'phone' => $request->phone,
            'account_bank' => $request->account_bank,
            'name_bank' => $request->name_bank,
            'day_start' => Carbon::now($request->day_start),
            'status' => $request->status | 1,
            'position_id' => $request->position_id
        ]);

        if ($employee) {
            $position = Position::find($employee->position_id);
            if ($position->permission = '1') {
                $account = $employee->account()->create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => $request->password,
                    'enabled' => $request->enabled | '1',
                    'role_id' => $request->role_id | '2'
                ]);
                $employee = Employee::updated([
                    $employee->account_id = $account->id
                ]);
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Employee Added Successfully',
            'user' => $account,
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
            'gender',
            'birthday',
            'CMND',
            'address',
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
}
