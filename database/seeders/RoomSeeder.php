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
                'tmp_name' => 'Standard Room-',
                'tmp_image' => 'normal_room',
                'type' => 'normal',
                'service_fee' => 0,
            ],
            [
                'tmp_name' => 'Family Room-',
                'tmp_image' => 'family_room',
                'type' => 'family',
                'service_fee' => 20000,
            ],
            [
                'tmp_name' => 'Private Room-',
                'tmp_image' => 'private_room',
                'type' => 'private',
                'service_fee' => 30000,
            ],
            [
                'tmp_name' => 'VIP Room-',
                'tmp_image' => 'vip_room',
                'type' => 'vip',
                'service_fee' => 50000,
            ],
        ];

        foreach ($rooms as $roomData) {
            for ($i = 1; $i <= 3; $i++) {
                $uploadFilename = $roomData['tmp_image'] . $i . '.jpg';
                $filename = $this->uploadImageFile($uploadFilename);
                $roomData['image'] = $filename;
                $roomData['name'] = $roomData['tmp_name'] . $i;
                Room::create($this->prepareRoomData($roomData));
            }
        }
    }

    public function prepareRoomData($data)
    {
        return [
            'image' => $data['image'],
            'name' => $data['name'],
            'type' => $data['type'],
            'service_fee' => $data['service_fee'],
        ];
    }

    public function uploadImageFile($filename)
    {
        $extension = '.png';
        $storedFileName = '-';
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
