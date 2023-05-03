<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $price = $request->price;
        $services = $request->input('services');

        $list_filter_services = [];

        if ($price != 0) {
            if (count($services) != 0) {
                $list_filter_services = DB::table('services')
                    ->where('price', '<=', $price)
                    ->where(function ($query) use ($services) {
                        foreach ($services as $service) {
                            $query->orWhere('service_name', 'LIKE', '%' . $service . '%');
                        }
                    })
                    ->get();
            } else {
                $list_filter_services = DB::table('services')
                    ->where('price', '<=', $price)
                    ->get();
            }
        } else {
            if (count($services) != 0) {
                $list_filter_services = DB::table('services')
                    ->where(function ($query) use ($services) {
                        foreach ($services as $service) {
                            $query->orWhere('service_name', 'LIKE', '%' . $service . '%');
                        }
                    })
                    ->get();
            } else {
                $list_filter_services = DB::table('services')->get();
            }
        }

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_filter_services' => $list_filter_services,
        ], 200);
    }

    public function getLowestPrice()
    {
        $lowest_price = DB::table('services')->min('price');

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'lowest_price' => $lowest_price,
        ], 200);
    }

    public function getHighestPrice()
    {
        $highest_price = DB::table('services')->max('price');

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'highest_price' => $highest_price,
        ], 200);
    }

    public function getListServiceNames() {
        $list_service_names = DB::table('services')->get(['service_name']);

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_service_names' => $list_service_names,
        ], 200);
    }
}
