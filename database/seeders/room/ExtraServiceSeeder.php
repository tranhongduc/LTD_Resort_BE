<?php

namespace Database\Seeders\room;

use App\Models\room\ExtraService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtraServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extra_services_name = [
            'Snack Oishi', 'Snack Poca', 'Snack O\'star', 'Snack Swing', 'Snack Lay\'s',
            'Ly mì Modern lẩu Thái tôm 65g', 'Ly mì khoai tây Omachi tôm chua cay 112g', 
            'Lon nước ngọt coca 330ml', 'Lon nước ngọt 7up 330ml',
            'Nước cam Twister', 'Trà xanh không độ', 'Nước suối' 
        ];

        $bedroom_types = [
            
        ];

        $room_types = ['Superior Room', 'Deluxe Room', 'Executive Room', 'Suite Room'];

        $bedroom_types_price = [200000, 240000, 250000, 300000, 400000];
        $room_types_price = [1.2, 1.4, 1.5, 2.5, 3];

        $room_types_price = [1.2, 1.4, 1.5, 2.5, 3];

        $room_sizes = [20, 25, 30, 35, 40];

        $number_rooms = [50, 40, 45, 30, 20];
        $number_customers = [1, 2, 2, 3, 4];

        $list_point_rankings = [200, 250, 300, 350, 400];

        for ($i = 0; $i < count($extra_services_name); $i++) {
            ExtraService::factory()->create([
                'extra_service_name' => $extra_services_name[$i],
                'description' => fake()->sentence(),
                'image' => fake()->imageUrl(),
                'price' => 15000,
                'quantity' => 3,
            ]);
        }
    }
}
