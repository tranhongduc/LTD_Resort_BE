<?php

namespace Database\Seeders\user;

use App\Models\user\Account;
use App\Models\user\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $role_model = new Role();
        // $admin_roles = $role_model->newQuery()->where('role_name', '=', 'ADMIN');
        // $employee_roles = $role_model->newQuery()->where('role_name', '=', 'EMPLOYEE');
        // $customer_roles = $role_model->newQuery()->where('role_name', '=', 'CUSTOMER');

        define('TOTAL_ACCOUNT', 20);

        for ($i = 0; $i < TOTAL_ACCOUNT; $i++) {
            $role_id = fake()->randomElement(['1', '2', '3']);
            
            // if ($account_type == 'ADMIN') {
            //     $role_id = fake()->randomElement($admin_roles);
            // } else if ($account_type == 'EMPLOYEE') {
            //     $role_id = fake()->randomElement($employee_roles);
            // } else {
            //     $role_id = fake()->randomElement($customer_roles);
            // }

            Account::factory()->create([
                // 'account_type' => $account_type,
                'role_id' => $role_id,
            ]);
        }
    }
}
