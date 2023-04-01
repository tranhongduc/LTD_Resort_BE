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
        $account_model = new Account();
        $admin_accounts = $account_model->newQuery()->where('account_type', '=', 'ADMIN')->get();

        for ($i = 0; $i < count($admin_accounts); $i++) {
            Admin::factory()->create([
                'account_id' => $admin_accounts[$i]->id
            ]);
        }
    }
}
