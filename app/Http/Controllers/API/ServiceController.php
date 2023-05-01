<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\service\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
        $list_services = Service::all();
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_services' => $list_services,
        ], 200);
    }

    public function show($id) {
        $service = Service::find($id);
        if ($service) {
            return response()->json([
                'message' => 'Query successfully!',
                'status' => 200,
                'room_type' => $service,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found!',
                'status' => 404,
                'room_type' => $service,
            ], 404);
        }
    }

    public function filterService(Request $request) {
        
    }
}
