<?php

namespace Database\Seeders\user;

use App\Models\Ranking;
use App\Models\user\Account;
use App\Models\user\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $account_model = new Account();
        $customer_accounts = $account_model->newQuery()->where('account_type', '=', 'CUSTOMER')->get();

        $ranking_model = new Ranking();
        $list_rankings = $ranking_model->newQuery()->get('id');

        for ($i = 0; $i < count($customer_accounts); $i++) {
            Customer::factory()->create([
                'account_id' => $customer_accounts[$i]->id,
                'ranking_id' => fake()->randomElement($list_rankings),
            ]);
        }
    }
}
