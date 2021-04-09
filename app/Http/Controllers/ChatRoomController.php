<?php

namespace App\Http\Controllers;

use App\Events\ChatRoomEvent;
use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{


    public function index() {
        $chatRooms = ChatRoom::all();

        return $chatRooms;
    }

    public function store(Request $request) {
        $chatRoom = ChatRoom::create($request->all())->toArray();

        broadcast(new ChatRoomEvent($chatRoom));

        if($chatRoom) {
            return response()->json(['status' => 'success']);
        }
    }

    public function view(Request $request) {
        return view('chatroom');
    }

}
