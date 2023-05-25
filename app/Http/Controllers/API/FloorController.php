<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FloorController extends Controller
{
    public function index()
    {
        $list_floors = DB::table('floors')->get();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_floors' => $list_floors,
        ], 200);
    }

    public function show($id)
    {
        $floor = DB::table('floors')->where('id', '=', $id)->first();

        if ($floor) {
            return response()->json([
                'message' => 'Query successfully!',
                'status' => 200,
                'floor' => $floor,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found!',
                'status' => 404,
                'floor' => $floor,
            ], 404);
        }
    }

    public function getTotalFloors() {
        $total_floors = DB::table('floors')->count();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'total_floors' => $total_floors,
        ], 200);
    }
}
