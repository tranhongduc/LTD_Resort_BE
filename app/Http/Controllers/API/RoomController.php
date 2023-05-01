<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\room\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index() {
        $list_room_types = RoomType::all();
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_room_types' => $list_room_types,
        ], 200);
    }

    public function show($id) {
        $room_type = RoomType::find($id);
        if ($room_type) {
            return response()->json([
                'message' => 'Query successfully!',
                'status' => 200,
                'room_type' => $room_type,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found!',
                'status' => 404,
                'room_type' => $room_type,
            ], 404);
        }
    }

    public function findRoomType(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'check_in' => 'required',
            'check_out' => 'required',
        ]);

        if($validator->fails()){
            $response =[
                'status_code' => 400,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }
    }

    public function filterRoomType(Request $request) {

    }
}
