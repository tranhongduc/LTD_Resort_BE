<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\room\AreaSeeder;
use Database\Seeders\room\FloorSeeder;
use Database\Seeders\user\AccountSeeder;
use Database\Seeders\user\AdminSeeder;
use Database\Seeders\user\EmployeeSeeder;
use Database\Seeders\user\CustomerSeeder;
use Database\Seeders\user\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);  
        $this->call(RankingSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(FloorSeeder::class);
    }
}