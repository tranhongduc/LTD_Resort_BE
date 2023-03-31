<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\user\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeModel = new Employee();
        $listEmployees = $employeeModel->newQuery()->get();

        for ($i = 0; $i < count($listEmployees); $i++) {
            Blog::factory(5)->create([
                'employee_id' => $listEmployees[$i]->id
            ]);
        }
    }
}
