<?php

namespace Database\Seeders\room;

use App\Models\room\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        define('NUMBER_OF_AREAS', 7);

        $areas_zone = ['A', 'B', 'C', 'D', 'E', 'F', 'H'];
        
        for ($i = 0; $i < NUMBER_OF_AREAS; $i++) {
            Area::factory()->create([
                'area_name' => 'Khu' . ' ' . $areas_zone[$i]
            ]);
        }
    }
}
