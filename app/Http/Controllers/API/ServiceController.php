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

    public function getTotalServices() {
        $total_services = DB::table('services')->count();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'total_services' => $total_services,
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

    public function getTop5LowestPrice()
    {
        $list_lowest_price = DB::table('services')->orderBy('price', 'asc')->take(5)->get();
        
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_lowest_price' => $list_lowest_price
        ]);
    }

    public function paging(Request $request, $page_number, $num_of_page)
    {
        $data = [];

        $list_filter_services = $request->input('list_filter_services');

        if (count($list_filter_services) > 0) {
            if (count($list_filter_services) % $num_of_page == 0) {
                $page = count($list_filter_services) / $num_of_page;
            } else {
                $page = (int)(count($list_filter_services) / $num_of_page) + 1;
            }

            $start = ($page_number - 1) * $num_of_page;

            if ($page_number == $page) {
                for ($i = $start; $i < count($list_filter_services); $i++) {
                    $data[] = [
                        "id" => $list_filter_services[$i]['id'],
                        "service_name" => $list_filter_services[$i]['service_name'],
                        "image" => $list_filter_services[$i]['image'],
                        "description" => $list_filter_services[$i]['description'],
                        "status" => $list_filter_services[$i]['status'],
                        "price" => $list_filter_services[$i]['price'],
                        "point_ranking" => $list_filter_services[$i]['point_ranking'],
                        "service_type_id" => $list_filter_services[$i]['service_type_id'],
                        "created_at" => $list_filter_services[$i]['created_at'],
                        "updated_at" => $list_filter_services[$i]['updated_at'],
                    ];
                }
            } else if ($page_number > $page) {
                $data = [];
            } else {
                for ($i = $start; $i < $start + $num_of_page; $i++) {
                    $data[] = [
                        "id" => $list_filter_services[$i]['id'],
                        "service_name" => $list_filter_services[$i]['service_name'],
                        "image" => $list_filter_services[$i]['image'],
                        "description" => $list_filter_services[$i]['description'],
                        "status" => $list_filter_services[$i]['status'],
                        "price" => $list_filter_services[$i]['price'],
                        "point_ranking" => $list_filter_services[$i]['point_ranking'],
                        "service_type_id" => $list_filter_services[$i]['service_type_id'],
                        "created_at" => $list_filter_services[$i]['created_at'],
                        "updated_at" => $list_filter_services[$i]['updated_at'],
                    ];
                }
            }
        } else {
            $list_services = DB::table('services')->get();
            if (count($list_services) > 0) {
                if (count($list_services) % $num_of_page == 0) {
                    $page = count($list_services) / $num_of_page;
                } else {
                    $page = (int)(count($list_services) / $num_of_page) + 1;
                }
    
                $start = ($page_number - 1) * $num_of_page;
                $data = [];
    
                if ($page_number == $page) {
                    for ($i = $start; $i < count($list_services); $i++) {
                        $data[] = [
                            "id" => $list_services[$i]->id,
                            "service_name" => $list_services[$i]->service_name,
                            "image" => $list_services[$i]->image,
                            "description" => $list_services[$i]->description,
                            "status" => $list_services[$i]->status,
                            "price" => $list_services[$i]->price,
                            "point_ranking" => $list_services[$i]->point_ranking,
                            "service_type_id" => $list_services[$i]->service_type_id,
                            "created_at" => $list_services[$i]->created_at,
                            "updated_at" => $list_services[$i]->updated_at,
                        ];
                    }
                } else if ($page_number > $page) {
                    $data = [];
                } else {
                    for ($i = $start; $i < $start + $num_of_page; $i++) {
                        $data[] = [
                            "id" => $list_services[$i]->id,
                            "service_name" => $list_services[$i]->service_name,
                            "image" => $list_services[$i]->image,
                            "description" => $list_services[$i]->description,
                            "status" => $list_services[$i]->status,
                            "price" => $list_services[$i]->price,
                            "point_ranking" => $list_services[$i]->point_ranking,
                            "service_type_id" => $list_services[$i]->service_type_id,
                            "created_at" => $list_services[$i]->created_at,
                            "updated_at" => $list_services[$i]->updated_at,
                        ];
                    }
                }
            }
        }

        return response()->json([
            'status' => 200,
            'list_services' => $data,
        ]);
    }
}
