<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function index()
    {
        $list_feedbacks = DB::table('feedback')->get();

        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_feedbacks' => $list_feedbacks,
        ], 200);
    }

    public function show($id)
    {
        $feedback = DB::table('feedback')->find($id);
        if ($feedback) {
            return response()->json([
                'message' => 'Query successfully!',
                'status' => 200,
                'feedback' => $feedback,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found!',
                'status' => 404,
                'feedback' => $feedback,
            ], 404);
        }
    }

    public function getAllFeedbackRooms()
    {
        $list_feedback_rooms = DB::table('feedback')->where('feedback_type', '=', 'ROOM')->get();
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_feedback_rooms' => $list_feedback_rooms,
        ], 200);
    }

    public function getAllFeedbackServices()
    {
        $list_feedback_services = DB::table('feedback')->where('feedback_type', '=', 'SERVICE')->get();
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_feedback_services' => $list_feedback_services,
        ], 200);
    }

    public function getFeedbackByRoomTypeId($id)
    {
        // $customer_id = DB::table('feedback')->where('feedback_type', '=', 'ROOM')
        $list_feedback_rooms = DB::table('feedback')
            ->where('room_type_id', '=', $id)
            ->join('customers', 'customers.id', '=', 'feedback.customer_id')
            ->join('accounts', 'accounts.id', '=', 'customers.account_id')
            ->select([
                'feedback.id', 'date_request', 'date_response', 'title', 'rating',
                'comment', 'feedback_status', 'customers.full_name', 'accounts.username', 'accounts.avatar'
            ])
            ->get();
        return response()->json([
            'message' => 'Query successfully!',
            'status' => 200,
            'list_feedback_rooms' => $list_feedback_rooms,
        ], 200);
    }
}
