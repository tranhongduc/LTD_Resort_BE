<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\user\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $listAdmin = Admin::all();
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_accounts' => $listAdmin
        ]);
    }
    
    public function searchByParams($search)
    {
        if ($search) {
            $result  = Admin::where('full_name', 'LIKE', "%{$search}%")->get();

            if (count($result) > 0) {
                return response()->json([
                    'status' => 200,
                    'data' => $result
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not search'
                ]);
            }
        }
    }
    public function adminFindID($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $position = Position::find($admin->position_id);
            if ($position) {
                $department = Department::find($position->department_id);

                $data[] = [
                    "id" => $admin->id,
                    "name" => $admin->full_name,
                    "gender" => $admin->gender,
                    "birthday" => $admin->birthday,
                    "CMND" => $admin->CMND,
                    "address" => $admin->address,
                    "phone" => $admin->phone,
                    "position_name" => $position->position_name,
                    "department_name" => $department->department_name

                ];
                return response()->json([
                    'status' => 200,
                    'message' => 'OK',
                    'data' => $data
                ]);
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No ID Found',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            return response()->json([
                'status' => 200,
                'message' => 'OK',
                'admin' => $admin,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No ID Found',
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
            'gender',
            'birthday',
            'CMND',
            'address',
            'phone',


        ]);
        if ($validator->fails()) {
            return response()->json([
                'validate' => true,
                'message' => 'You need to enter admin',
            ]);
        }
        //
        $admin = Admin::find($id);
        if ($admin) {
            $admin->full_name = $request->full_name;
            $admin->gender = $request->gender;
            $admin->birthday = $request->birthday;
            $admin->CMND = $request->CMND;
            $admin->address = $request->address;
            $admin->phone = $request->phone;
            $admin->update();
            return response()->json([
                'status' => 200,
                'message' => 'Question Updated Successfully',
                // 're' => $admin,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No ID Found',
            ]);
        }
    }
}
