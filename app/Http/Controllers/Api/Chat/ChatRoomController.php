<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Api\ApiController;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JsonException;

class ChatRoomController extends ApiController
{
    public function getChatRooms()
    {
        $chatRooms = ChatRoom::all();

        return $this->respond(['data' => $chatRooms]);
    }

    public function createNewChatRoom(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'subject' => 'required|string',
            ]);

            $chatRoom = ChatRoom::create([
                'name' => $validatedData['name'],
                'subject' => $validatedData['subject'],
                'created_by' => $request->user()->id,
            ]);

            return $this->respondCreated(['data' => $chatRoom]);
        } catch (JsonException $e) {
            logger($e, $e->getTrace());

            return $this->respondError('Failed to create room', Response::HTTP_BAD_REQUEST);
        }
    }

    public function getChatRoomById($uuid)
    {
        $chatRoom = ChatRoom::find($uuid);
        if (! $chatRoom) {
            return $this->respondNotFound('Room not found');
        }

        return $this->respond(['data' => $chatRoom]);
    }

    public function destroy($uuid)
    {
        try {
            $chatRoom = ChatRoom::find($uuid);
            if (! $chatRoom) {
                return $this->respondNotFound('Room not found');
            }
            $chatRoom->delete();

            return $this->respond(['message' => 'Chat room deleted successfully']);
        } catch (JsonException $e) {
            logger($e, $e->getTrace());

            return $this->respondError('Failed to create room', Response::HTTP_BAD_REQUEST);
        }
    }
}
