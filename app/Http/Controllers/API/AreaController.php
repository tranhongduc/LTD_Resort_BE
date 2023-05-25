<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\room\Area;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function index()
    {
        $list_areas = DB::table('areas')->get();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_areas' => $list_areas,
        ], 200);
    }

    public function show($id)
    {
        $area = DB::table('areas')->where('id', '=', $id)->first();

        if ($area) {
            return response()->json([
                'message' => 'Query successfully!',
                'status' => 200,
                'area' => $area,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found!',
                'status' => 404,
                'area' => $area,
            ], 404);
        }
    }

    public function getTotalAreas() {
        $total_areas = DB::table('areas')->count();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'total_areas' => $total_areas,
        ], 200);
    }
}
