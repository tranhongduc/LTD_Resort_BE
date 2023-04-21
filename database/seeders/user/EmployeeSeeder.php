<?php

namespace Database\Seeders\user;

use App\Models\Department;
use App\Models\user\Account;
use App\Models\user\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $account_model = new Account();
        $employee_accounts = $account_model->newQuery()->where('role_id', '=', '2')->get();

        $department_model = new Department();
        $list_departments = $department_model->newQuery()->get('id');

        for ($i = 0; $i < count($employee_accounts); $i++) {
            Employee::factory()->create([
                'account_id' => $employee_accounts[$i]->id,
                'department_id' => fake()->randomElement($list_departments),
            ]);
        }
    }
}
