<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillServiceController extends Controller
{
    public function findBillService()
    {       
             $bill_service = DB::table('bill_services')
            ->whereNotNull('pay_time')
            ->whereNull('checkin_time')
            ->get();
           
            if ($bill_service ->isEmpty())  {
                return response()->json([
                        'message' => 'Data not found!',
                        'status' => 400,
                ]);
            } else {
                $data=[];
                foreach ($bill_service as $item1) {
                    $name = DB::table('customers')->where('id', '=', $item1->customer_id)->first();
                    $service = DB::table('services')->where('id', '=', $item1->service_id)->first();
                    $service_type= DB::table('service_types')->where('id', '=', $service->service_type_id)->first();
                    $data1[]=[
                        'full_name'=>$name->full_name,
                        'birthday'=>$name->birthday,
                        'phone'=>$name->phone,
                        'quantity'=> $item1->quantity,
                        'total_amount' => $item1->total_amount,
                        'book_time' => $item1->book_time,
                        'payment_method'=>$item1->payment_method,
                        'pay_time'=>$item1->pay_time,
                        'tax'=>$item1->tax,
                        'discount'=>$item1->discount,
                        'service'=>$service->service_name,
                        'service_type'=>$service_type->service_type_name,
                        'code'=>$item1->id,
                    ];    
                }
            
                return response()->json([
                    'message' => 'Query successfully!',
                    'status' => 200,
                    'bill_room' => $data1,
                ]);
            }
    }
    public function findHistoryService()
    {       
             $bill_service = DB::table('bill_services')
            ->whereNotNull('checkin_time')
            ->get();
           
            if ($bill_service ->isEmpty())  {
                return response()->json([
                        'message' => 'Data not found!',
                        'status' => 400,
                ]);
            } else {
                $data=[];
                foreach ($bill_service as $item1) {
                    $name = DB::table('customers')->where('id', '=', $item1->customer_id)->first();
                    $service = DB::table('services')->where('id', '=', $item1->service_id)->first();
                    $service_type= DB::table('service_types')->where('id', '=', $service->service_type_id)->first();
                    $data1[]=[
                        'full_name'=>$name->full_name,
                        'birthday'=>$name->birthday,
                        'phone'=>$name->phone,
                        'quantity'=> $item1->quantity,
                        'total_amount' => $item1->total_amount,
                        'book_time' => $item1->book_time,
                        'payment_method'=>$item1->payment_method,
                        'pay_time'=>$item1->pay_time,
                        'tax'=>$item1->tax,
                        'discount'=>$item1->discount,
                        'service'=>$service->service_name,
                        'service_type'=>$service_type->service_type_name,
                        'code'=>$item1->id,
                    ];    
                }
            
                return response()->json([
                    'message' => 'Query successfully!',
                    'status' => 200,
                    'bill_room' => $data1,
                ]);
            }
    }
    public function findCancelService()
    {       
             $bill_service = DB::table('bill_services')
            ->whereNotNull('checkin_time')
            ->get();
           
            if ($bill_service ->isEmpty())  {
                return response()->json([
                        'message' => 'Data not found!',
                        'status' => 400,
                ]);
            } else {
                $data=[];
                foreach ($bill_service as $item1) {
                    $name = DB::table('customers')->where('id', '=', $item1->customer_id)->first();
                    $service = DB::table('services')->where('id', '=', $item1->service_id)->first();
                    $service_type= DB::table('service_types')->where('id', '=', $service->service_type_id)->first();
                    $data1[]=[
                        'full_name'=>$name->full_name,
                        'birthday'=>$name->birthday,
                        'phone'=>$name->phone,
                        'quantity'=> $item1->quantity,
                        'total_amount' => $item1->total_amount,
                        'book_time' => $item1->book_time,
                        'payment_method'=>$item1->payment_method,
                        'pay_time'=>$item1->pay_time,
                        'tax'=>$item1->tax,
                        'discount'=>$item1->discount,
                        'service'=>$service->service_name,
                        'service_type'=>$service_type->service_type_name,
                        'code'=>$item1->id,
                    ];    
                }
            
                return response()->json([
                    'message' => 'Query successfully!',
                    'status' => 200,
                    'bill_room' => $data1,
                ]);
            }
    }
}
