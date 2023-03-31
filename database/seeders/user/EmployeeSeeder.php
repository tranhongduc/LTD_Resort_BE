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
        $accountModel = new Account();
        $employeeAccounts = $accountModel->newQuery()->where('account_type', '=', 'EMPLOYEE')->get();

        $departmentModel = new Department();
        $listDepartments = $departmentModel->newQuery()->get('id');

        for ($i = 0; $i < count($employeeAccounts); $i++) {
            Employee::factory()->create([
                'account_id' => $employeeAccounts[$i]->id,
                'department_id' => fake()->randomElement($listDepartments),
            ]);
        }
    }
}
