<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\PublicChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

        public function getDashboard()
        {
            $user = Auth::user();

            $userProfile =$user;
            $messageCount = Message::count();
            $chatRoomCount = ChatRoom::count();

            $publicChats = PublicChat::where('hidden', false)->get(['id', 'content', 'hidden', 'created_by', 'created_at', 'updated_at']);

            $response = [
                'userProfile' => $userProfile,
                'messageCount' => $messageCount,
                'chatRoomCount' => $chatRoomCount,
                'publicChats' => $publicChats
            ];

            return response()->json($response, 200);
        }

}
