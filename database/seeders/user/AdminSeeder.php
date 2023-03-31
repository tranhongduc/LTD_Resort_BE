<?php

namespace Database\Seeders\user;

use App\Models\user\Account;
use App\Models\user\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accountModel = new Account();
        $adminAccounts = $accountModel->newQuery()->where('account_type', '=', 'ADMIN')->get();

        for ($i = 0; $i < count($adminAccounts); $i++) {
            Admin::factory()->create([
                'account_id' => $adminAccounts[$i]->id
            ]);
        }
    }
}
