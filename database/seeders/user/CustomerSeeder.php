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
        $accountModel = new Account();
        $customerAccounts = $accountModel->newQuery()->where('account_type', '=', 'CUSTOMER')->get();

        $rankingModel = new Ranking();
        $listRankings = $rankingModel->newQuery()->get('id');

        for ($i = 0; $i < count($customerAccounts); $i++) {
            Customer::factory()->create([
                'account_id' => $customerAccounts[$i]->id,
                'ranking_id' => fake()->randomElement($listRankings),
            ]);
        }
    }
}
