<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\PublicChat;
use Illuminate\Http\Request;

class DashboardController extends ApiController
{

    public function getDashboard(Request $request)
    {
        $user = $request->user();

        $userProfile = $user;
        $messageCount = Message::count();
        $chatRoomCount = ChatRoom::count();

        $publicChats = PublicChat::all();

        $response = [
            'userProfile' => $userProfile,
            'messageCount' => $messageCount,
            'chatRoomCount' => $chatRoomCount,
            'publicChats' => $publicChats
        ];

        return $this->respond($response);
    }
}
