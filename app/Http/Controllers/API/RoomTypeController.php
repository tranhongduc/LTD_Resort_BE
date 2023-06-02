<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\room\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RoomTypeController extends Controller
{
    public function index()
    {
        $list_room_types = RoomType::all();
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_room_types' => $list_room_types,
        ], 200);
    }

    public function show($id)
    {
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

    public function findRoomType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'check_in' => 'required',
            'check_out' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status_code' => 400,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }
    }

    public function filterRoomType(Request $request)
    {
        $price = $request->price;
        $room_size = $request->room_size;
        $bedroom_type = $request->input('bedroom_type');
        $room_type = $request->input('room_type');

        $list_filter_room_type = [];

        if ($price != 0) {
            if ($room_size != 0) {
                if (count($bedroom_type) != 0) {
                    if (count($room_type) != 0) {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('price', '<=', $price)
                            ->where('room_size', '<=', $room_size)
                            ->where(function ($query) use ($bedroom_type) {
                                foreach ($bedroom_type as $bedroom) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $bedroom . '%');
                                }
                            })
                            ->where(function ($query) use ($room_type) {
                                foreach ($room_type as $room) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $room . '%');
                                }
                            })
                            ->get();
                    } else {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('price', '<=', $price)
                            ->where('room_size', '<=', $room_size)
                            ->where(function ($query) use ($bedroom_type) {
                                foreach ($bedroom_type as $bedroom) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $bedroom . '%');
                                }
                            })
                            ->get();
                    }
                } else {
                    if (count($room_type) != 0) {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('price', '<=', $price)
                            ->where('room_size', '<=', $room_size)
                            ->where(function ($query) use ($room_type) {
                                foreach ($room_type as $room) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $room . '%');
                                }
                            })
                            ->get();
                    } else {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('price', '<=', $price)
                            ->where('room_size', '<=', $room_size)
                            ->get();
                    }
                }
            } else {
                if (count($bedroom_type) != 0) {
                    if (count($room_type) != 0) {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('price', '<=', $price)
                            ->where(function ($query) use ($bedroom_type) {
                                foreach ($bedroom_type as $bedroom) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $bedroom . '%');
                                }
                            })
                            ->where(function ($query) use ($room_type) {
                                foreach ($room_type as $room) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $room . '%');
                                }
                            })
                            ->get();
                    } else {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('price', '<=', $price)
                            ->where(function ($query) use ($bedroom_type) {
                                foreach ($bedroom_type as $bedroom) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $bedroom . '%');
                                }
                            })
                            ->get();
                    }
                } else {
                    if (count($room_type) != 0) {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('price', '<=', $price)
                            ->where(function ($query) use ($room_type) {
                                foreach ($room_type as $room) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $room . '%');
                                }
                            })
                            ->get();
                    } else {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('price', '<=', $price)
                            ->get();
                    }
                }
            }
        } else {
            if ($room_size != 0) {
                if (count($bedroom_type) != 0) {
                    if (count($room_type) != 0) {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('room_size', '<=', $room_size)
                            ->where(function ($query) use ($bedroom_type) {
                                foreach ($bedroom_type as $bedroom) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $bedroom . '%');
                                }
                            })
                            ->where(function ($query) use ($room_type) {
                                foreach ($room_type as $room) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $room . '%');
                                }
                            })
                            ->get();
                    } else {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('room_size', '<=', $room_size)
                            ->where(function ($query) use ($bedroom_type) {
                                foreach ($bedroom_type as $bedroom) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $bedroom . '%');
                                }
                            })
                            ->get();
                    }
                } else {
                    if (count($room_type) != 0) {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('room_size', '<=', $room_size)
                            ->where(function ($query) use ($room_type) {
                                foreach ($room_type as $room) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $room . '%');
                                }
                            })
                            ->get();
                    } else {
                        $list_filter_room_type = DB::table('room_types')
                            ->where('room_size', '<=', $room_size)
                            ->get();
                    }
                }
            } else {
                if (count($bedroom_type) != 0) {
                    if (count($room_type) != 0) {
                        $list_filter_room_type = DB::table('room_types')
                            ->where(function ($query) use ($bedroom_type) {
                                foreach ($bedroom_type as $bedroom) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $bedroom . '%');
                                }
                            })
                            ->where(function ($query) use ($room_type) {
                                foreach ($room_type as $room) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $room . '%');
                                }
                            })
                            ->get();
                    } else {
                        $list_filter_room_type = DB::table('room_types')
                            ->where(function ($query) use ($bedroom_type) {
                                foreach ($bedroom_type as $bedroom) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $bedroom . '%');
                                }
                            })
                            ->get();
                    }
                } else {
                    if (count($room_type) != 0) {
                        $list_filter_room_type = DB::table('room_types')
                            ->where(function ($query) use ($room_type) {
                                foreach ($room_type as $room) {
                                    $query->orWhere('room_type_name', 'LIKE', '%' . $room . '%');
                                }
                            })
                            ->get();
                    } else {
                        $list_filter_room_type = DB::table('room_types')->get();
                    }
                }
            }
        }

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_filter_room_type' => $list_filter_room_type,
        ], 200);
    }

    public function getTotalRoomTypes() {
        $total_room_types = DB::table('room_types')->count();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'total_room_types' => $total_room_types,
        ], 200);
    }

    public function getTotalNumerOfRoomByRoomTypeId($id) {
        $number_of_rooms = DB::table('rooms')->where('room_type_id', '=', $id)->count();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'number_of_rooms' => $number_of_rooms,
        ], 200);
    }

    public function getListRoomsByRoomTypeId($id) {
        $list_rooms = DB::table('rooms')->where('room_type_id', '=', $id)->get();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_rooms' => $list_rooms,
        ], 200);
    }

    public function getLowestPrice()
    {
        $lowest_price = DB::table('room_types')->min('price');

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'lowest_price' => $lowest_price,
        ], 200);
    }

    public function getHighestPrice()
    {
        $highest_price = DB::table('room_types')->max('price');

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'highest_price' => $highest_price,
        ], 200);
    }

    public function getSmallestRoomSize()
    {
        $smallest_room_size = DB::table('room_types')->min('room_size');

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'smallest_room_size' => $smallest_room_size,
        ], 200);
    }

    public function getBiggestRoomSize()
    {
        $biggest_room_size = DB::table('room_types')->max('room_size');

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'biggest_room_size' => $biggest_room_size,
        ], 200);
    }

    public function getListRoomTypeName()
    {
        $list_room_type_name = DB::table('room_types')->get(['room_type_name']);
        $result = array();
        foreach ($list_room_type_name as $room_type) {
            $bedroom_type = substr($room_type->room_type_name, 0, strpos($room_type->room_type_name, ' - '));
            $room_type = substr($room_type->room_type_name, strpos($room_type->room_type_name, ' - ') + 3);

            $result[] = [
                'bedroom_type_name' => $bedroom_type,
                'room_type_name' => $room_type
            ];
        }

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_room_type_name' => $result,
        ], 200);
    }

    public function getBedroomTypeNames()
    {
        $room_type_names = DB::table('room_types')->select('room_type_name')->distinct()->get()->pluck('room_type_name');

        $formatted_room_type_names = [];
        foreach ($room_type_names as $room_type_name) {
            $pieces = explode('-', $room_type_name);
            $formatted_room_type_names[] = trim($pieces[0]);
        }

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'bedroom_type_names' => array_values(array_unique($formatted_room_type_names)),
        ]);
    }

    public function getRoomTypeNames()
    {
        $room_types = DB::table('room_types')->select('room_type_name')->get();
        $room_type_names = [];

        foreach ($room_types as $room_type) {
            $name_parts = explode('-', $room_type->room_type_name);
            $room_name = trim(end($name_parts));

            if (!in_array($room_name, $room_type_names)) {
                array_push($room_type_names, $room_name);
            }
        }

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'room_type_names' => $room_type_names
        ]);
    }

    public function getTop5LowestPrice()
    {
        $list_lowest_price = DB::table('room_types')->orderBy('price', 'asc')->take(5)->get();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_lowest_price' => $list_lowest_price
        ]);
    }

    public function paging(Request $request, $page_number, $num_of_page)
    {
        $data = [];

        $list_filter_room_types = $request->input('list_filter_room_types');

        if (count($list_filter_room_types) > 0) {
            if (count($list_filter_room_types) % $num_of_page == 0) {
                $page = count($list_filter_room_types) / $num_of_page;
            } else {
                $page = (int)(count($list_filter_room_types) / $num_of_page) + 1;
            }

            $start = ($page_number - 1) * $num_of_page;

            if ($page_number == $page) {
                for ($i = $start; $i < count($list_filter_room_types); $i++) {
                    $data[] = [
                        "id" => $list_filter_room_types[$i]['id'],
                        "room_type_name" => $list_filter_room_types[$i]['room_type_name'],
                        "room_size" => $list_filter_room_types[$i]['room_size'],
                        "number_customers" => $list_filter_room_types[$i]['number_customers'],
                        "description" => $list_filter_room_types[$i]['description'],
                        "image" => $list_filter_room_types[$i]['image'],
                        "price" => $list_filter_room_types[$i]['price'],
                        "point_ranking" => $list_filter_room_types[$i]['point_ranking'],
                        "created_at" => $list_filter_room_types[$i]['created_at'],
                        "updated_at" => $list_filter_room_types[$i]['updated_at'],
                    ];
                }
            } else if ($page_number > $page) {
                $data = [];
            } else {
                for ($i = $start; $i < $start + $num_of_page; $i++) {
                    $data[] = [
                        "id" => $list_filter_room_types[$i]['id'],
                        "room_type_name" => $list_filter_room_types[$i]['room_type_name'],
                        "room_size" => $list_filter_room_types[$i]['room_size'],
                        "number_customers" => $list_filter_room_types[$i]['number_customers'],
                        "description" => $list_filter_room_types[$i]['description'],
                        "image" => $list_filter_room_types[$i]['image'],
                        "price" => $list_filter_room_types[$i]['price'],
                        "point_ranking" => $list_filter_room_types[$i]['point_ranking'],
                        "created_at" => $list_filter_room_types[$i]['created_at'],
                        "updated_at" => $list_filter_room_types[$i]['updated_at'],
                    ];
                }
            }
        } else {
            $list_room_types = DB::table('room_types')->get();
            if (count($list_room_types) > 0) {
                if (count($list_room_types) % $num_of_page == 0) {
                    $page = count($list_room_types) / $num_of_page;
                } else {
                    $page = (int)(count($list_room_types) / $num_of_page) + 1;
                }
    
                $start = ($page_number - 1) * $num_of_page;
    
                if ($page_number == $page) {
                    for ($i = $start; $i < count($list_room_types); $i++) {
                        $data[] = [
                            "id" => $list_room_types[$i]->id,
                            "room_type_name" => $list_room_types[$i]->room_type_name,
                            "room_size" => $list_room_types[$i]->room_size,
                            "number_customers" => $list_room_types[$i]->number_customers,
                            "description" => $list_room_types[$i]->description,
                            "image" => $list_room_types[$i]->image,
                            "price" => $list_room_types[$i]->price,
                            "point_ranking" => $list_room_types[$i]->point_ranking,
                            "created_at" => $list_room_types[$i]->created_at,
                            "updated_at" => $list_room_types[$i]->updated_at,
                        ];
                    }
                } else if ($page_number > $page) {
                    $data = [];
                } else {
                    for ($i = $start; $i < $start + $num_of_page; $i++) {
                        $data[] = [
                            "id" => $list_room_types[$i]->id,
                            "room_type_name" => $list_room_types[$i]->room_type_name,
                            "room_size" => $list_room_types[$i]->room_size,
                            "number_customers" => $list_room_types[$i]->number_customers,
                            "description" => $list_room_types[$i]->description,
                            "image" => $list_room_types[$i]->image,
                            "price" => $list_room_types[$i]->price,
                            "point_ranking" => $list_room_types[$i]->point_ranking,
                            "created_at" => $list_room_types[$i]->created_at,
                            "updated_at" => $list_room_types[$i]->updated_at,
                        ];
                    }
                }
            }
        }

        return response()->json([
            'status' => 200,
            'list_room_types' => $data,
        ]);
    }
}
