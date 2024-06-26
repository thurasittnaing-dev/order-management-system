<?php

namespace App\Services;

use App\Models\OrderTables;
use App\Models\Room;

class RoomService {
    public function index() {
        $query = Room::query()
                    ->withCount('orderTables')
                    ->when(request('name'),fn($query) => $query->where('name', 'LIKE', '%' . request('name') . '%'))
                    ->when(request('type'),fn($query)=>$query->where('type', request('type')));
        return [
            'i' => getTableIndexer(5),
            'count' => $query->count(),
            'rooms' => $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString(),
        ];
    }

    public function store($request) {
        try {
            //code...
            $image = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $image = $filename;
                $file->storeAs('public/rooms', $filename);
            }

            $data = $request->validated();
            $data['image'] = $image;

            Room::create($data);

            return [
                'status' => 'success',
                'message' => 'Successfully Created.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong!',
            ];
        }
    }

    public function update($request, $room) {
        try {
            //code...
            $data = $request->validated();

            if ($request->hasFile('file')) {
                $file_location = storage_path('app/public/rooms/') . $room->image;
                $checkFileExist = file_exists($file_location);
                if ($checkFileExist) {
                    unlink($file_location);
                }
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $data['image'] = $filename;
                $file->storeAs('public/rooms', $filename);
            }
            $room->update($data);
            return [
                'status' => 'success',
                'message' => 'Sucessfully Updated.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong!',
            ];
        }
    }

    public function destroy(Room $room) {
        try {
            //code...
            $filename = $room->image ?? 'test.png';
            $file_location = storage_path('app/public/rooms/') . $filename;
            $checkFileExist = file_exists($file_location);
            if ($checkFileExist) {
                unlink($file_location);
            }
            $room->delete();
            return [
                'status' => 'success',
                'message' => 'Sucessfully Deleted.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong!',
            ];
        }
    }
}
