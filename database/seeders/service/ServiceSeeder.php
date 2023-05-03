<?php

namespace Database\Seeders\service;

use App\Models\Feedback;
use App\Models\service\Service;
use App\Models\service\ServiceType;
use App\Models\user\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service_type_model = new ServiceType();
        $list_service_types_id = $service_type_model->newQuery()->get(['id']);
        $feedback_model = new Feedback();
        $list_feedbacks_id = $feedback_model->newQuery()->get('id');

        $list_food_services = [
            'Restaurants', 'Pool Bar'
        ];

        $list_entertainment_services = [
            'Swimming Pool', 'Golf Course', 'Tennis'
        ];


        $list_wedding_party_services = [
            'Conference Room', 'Outdoor Party'
        ];

        $list_health_care_services = [
            'Gym', 'Yoga', 'Spa'
        ];

        $list_local_travel_services = [
            'Visit Local Attractions', 'Bicycle Rental Service'
        ];

        for ($i = 0; $i < count($list_service_types_id); $i++) {
            switch($list_service_types_id[$i]->id) {
                case 1: 
                    for ($j = 0; $j < count($list_food_services); $j++) {
                        Service::factory()->create([
                            'service_name' => $list_food_services[$j],
                            'image' => 'gs://ltd-resort.appspot.com/services/' . $list_food_services[$j] . '.jpg',
                            'description' => fake()->sentence(),
                            'status' => 'AVAILABLE',
                            'price' => 200000,
                            'point_ranking' => 200,
                            'feedback_id' => fake()->randomElement($list_feedbacks_id),
                            'service_type_id' => $list_service_types_id[$i]->id
                        ]);
                    }
                    break;
                case 2:
                    for ($j = 0; $j < count($list_entertainment_services); $j++) {
                        Service::factory()->create([
                            'service_name' => $list_entertainment_services[$j],
                            'image' => 'gs://ltd-resort.appspot.com/services/' . $list_entertainment_services[$j] . '.jpg',
                            'description' => fake()->sentence(),
                            'status' => 'AVAILABLE',
                            'price' => 250000,
                            'point_ranking' => 250,
                            'feedback_id' => fake()->randomElement($list_feedbacks_id),
                            'service_type_id' => $list_service_types_id[$i]->id
                        ]);
                    }
                    break;
                case 3:
                    for ($j = 0; $j < count($list_wedding_party_services); $j++) {
                        Service::factory()->create([
                            'service_name' => $list_wedding_party_services[$j],
                            'image' => 'gs://ltd-resort.appspot.com/services/' . $list_wedding_party_services[$j] . '.jpg',
                            'description' => fake()->sentence(),
                            'status' => 'AVAILABLE',
                            'price' => 500000,
                            'point_ranking' => 300,
                            'feedback_id' => fake()->randomElement($list_feedbacks_id),
                            'service_type_id' => $list_service_types_id[$i]->id
                        ]);
                    }
                    break;
                case 4:
                    for ($j = 0; $j < count($list_health_care_services); $j++) {
                        Service::factory()->create([
                            'service_name' => $list_health_care_services[$j],
                            'image' => 'gs://ltd-resort.appspot.com/services/' . $list_health_care_services[$j] . '.jpg',
                            'description' => fake()->sentence(),
                            'status' => 'AVAILABLE',
                            'price' => 300000,
                            'point_ranking' => 250,
                            'feedback_id' => fake()->randomElement($list_feedbacks_id),
                            'service_type_id' => $list_service_types_id[$i]->id
                        ]);
                    }
                    break;
                case 5:
                    for ($j = 0; $j < count($list_local_travel_services); $j++) {
                        Service::factory()->create([
                            'service_name' => $list_local_travel_services[$j],
                            'image' => 'gs://ltd-resort.appspot.com/services/' . $list_local_travel_services[$j] . '.jpg',
                            'description' => fake()->sentence(),
                            'status' => 'AVAILABLE',
                            'price' => 400000,
                            'point_ranking' => 300,
                            'feedback_id' => fake()->randomElement($list_feedbacks_id),
                            'service_type_id' => $list_service_types_id[$i]->id
                        ]);
                    }
                    break;
                default:
                    break;
            }
        }
    }
}
