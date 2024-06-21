<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Requests\RoomStoreRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Services\RoomService;


class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index()
    {
        $data = $this->roomService->index();
        return view('backend/room.index', $data);
    }

    public function create()
    {
        return view('backend/room.create');
    }
    public function store(RoomStoreRequest $request)
    {
        $data = $this->roomService->store($request);
        return redirect()->route('room.index')->with($data['status'], $data['message']);
    }

    public function edit(Room $room)
    {
        return view('backend/room.edit', compact('room'));
    }
    public function update(Room $room, RoomUpdateRequest $request)
    {
        $data = $this->roomService->update($request, $room);
        return redirect()->route('room.index')->with($data['status'], $data['message']);
    }

    public function destroy(Room $room)
    {
        $data = $this->roomService->destroy($room);
        return redirect()->route('room.index')->with($data['status'], $data['message']);
    }
}
