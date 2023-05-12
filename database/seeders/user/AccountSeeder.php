<?php

namespace Database\Seeders\user;

use App\Models\user\Account;
use App\Models\user\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {               
        define('TOTAL_ACCOUNT', 20);
        for ($i = 0; $i < TOTAL_ACCOUNT; $i++) {
            Account::factory()->create([
                'username' => fake()->userName(),
                'email' => fake()->safeEmail(),
                'password' => Hash::make('123'),
                'avatar' => fake()->imageUrl(),
                'enabled' => fake()->boolean(95),
                'role_id' => fake()->randomElement([1, 2, 3]),
            ]);
        }
    }
}
