<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departmentNames = [
            'Bộ phận Tiền sảnh', 'Bộ phận Buồng phòng', 'Bộ phận Ẩm thực', 'Bộ phận Kinh doanh - Tiếp thị',
            'Bộ phận Tài chính - Kế toán', 'Bộ phận Hành chính - Nhân sự', 'Bộ phận Kỹ thuật', 
            'Bộ phận Bếp', 'Bộ phận khác'
        ];

        for ($i = 0; $i < count($departmentNames); $i++) { 
            Department::factory()->create([
                'department_name' => $departmentNames[$i]
            ]);
        }
    }
}
