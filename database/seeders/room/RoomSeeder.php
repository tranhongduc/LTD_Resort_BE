<?php

namespace Database\Seeders\room;


use App\Models\room\Room;
use App\Models\Feedback;
use App\Models\room\Area;
use App\Models\room\Floor;
use App\Models\room\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $area_model = new Area();
        $floor_model = new Floor();
        $room_type_model = new RoomType();

        $list_areas = $area_model->newQuery()->get();
        $list_floors = $floor_model->newQuery()->get();
        $list_room_types_id = $room_type_model->newQuery()->get('id');

        $areas_zone = ['A', 'B', 'C', 'D', 'E', 'F', 'H'];

        for($i = 0; $i < count($list_areas); $i++) {
            for ($j = 0; $j < count($list_floors); $j++) {
                Room::factory()->create([
                    'room_name' => $areas_zone[$i] . '00' . $list_floors[$j]->id,
                    'status' => fake()->boolean(90) ? 'AVAILABLE' : 'BOOKED',
                    'room_type_id' => fake()->randomElement($list_room_types_id),
                    'area_id' => $list_areas[$i]->id,
                    'floor_id' => $list_floors[$i]->id
                ]);
            }
        }

    }
}
