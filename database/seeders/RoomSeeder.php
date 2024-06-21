<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            [
                'name' => 'Standard Room 1',
                'image' => 'normal_room.jpg',
                'type' => 'normal',
                'service_fee' => '0',
            ],
            [
                'name' => 'Family Suite A',
                'image' => 'family_room.jpg',
                'type' => 'family',
                'service_fee' => '20000',
            ],
            [
                'name' => 'Private Room X',
                'image' => 'private_room.jpg',
                'type' => 'private',
                'service_fee' => '30000',
            ],
            [
                'name' => 'VIP Suite Z',
                'image' => 'vip_room.jpg',
                'type' => 'vip',
                'service_fee' => '50000',
            ],
        ];

        foreach ($rooms as $roomData) {
            $filename = $this->uploadImageFile($roomData['image']);
            $roomData['image'] = $filename;
            Room::create($roomData);
        }
    }

    public function uploadImageFile($filename)
    {
        $extension = '.png';
        $storedFileName = null;
        $defaultFileLocation = public_path('images/default_rooms/' . $filename);

        if (file_exists($defaultFileLocation)) {
            $fileContents = file_get_contents($defaultFileLocation);
            $storedFileName = uniqid() . $extension;
            $destinationPath = 'public/rooms/' . $storedFileName;
            Storage::put($destinationPath, $fileContents);
        }

        return $storedFileName;
    }
}
