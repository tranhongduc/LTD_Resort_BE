<?php

namespace Database\Seeders\user;

use App\Models\user\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_roles = [
            'Tổng giám đốc', 'Phó Tổng giám đốc', 'Giám đốc bộ phận khách hàng',
            'Giám đốc bộ phận lễ tân', 'Giám đốc Buồng phòng', 'Giám đốc bộ phận ẩm thực',
            'Giám đốc kinh doanh', 'Giám đốc tài chính, kế toán', 'Giám đốc bộ phận hành chính - nhân sự',
            'Giám đốc bộ phận Quan hệ khách hàng', 'Giám đốc tiếp thị truyền thông', 'Giám đốc tiền sảnh',
            'Giám đốc tiền sảnh ban đêm', 'Giám đốc bộ phận tiệc', 'Giám đốc bộ phận IT',
            'Giám sát lễ tân', 'Giám sát bộ phận đặt phòng', 'Giám sát bộ phận chăm sóc khách hàng',
            'Giám sát phòng vải', 'Giám sát vệ sinh khu vực công cộng', 'Giám sát tổ phục vụ/ tiệc/ pha chế',
            'Giám sát bộ phận Kỹ thuật', 'Giám sát bộ phận tạp vụ', 'Trưởng bộ phận hỗ trợ khách hàng',
            'Bếp trưởng bộ phận', 'Bếp phó', 'Bếp trưởng điều hành'
        ];

        $employee_roles = [
            'Nhân viên lễ  tân', 'Nhân viên thu ngân', 'Nhân viên đặt phòng',
            'Nhân viên chăm sóc khách hàng', 'Nhân viên tiền sảnh', 'Nhân viên hỗ trợ khách hàng',
            'Nhân viên làm phòng', 'Nhân viên giặt là', 'Nhân viên trông trẻ',
            'Nhân viên phục vụ', 'Nhân viên tiệc', 'Nhân viên pha chế rượu',
            'Lễ tân nhà hàng', 'Nhân viên pha chế cafe', 'Nhân viên chạy món',
            'Nhân viên kế toán tổng hợp', 'Nhân viên kế toán công nợ', 'Nhân viên kế toán nội bộ',
            'Nhân viên điện', 'Nhân viên nước', 'Nhân viên mộc',
            'Nhân viên thủ quỹ', 'Nhân viên thu mua', 'Nhân viên nhận hàng',
            'Nhân viên giữ kho', 'Nhân viên kiểm soát chi phí',
            'Nhân viên Marketing', 'Nhân viên sales khách công ty', 'Nhân viên sales khách tour',
            'Nhân viên sales trên Internet', 'Nhân viên sales nhà hàng/ tiệc', 'Nhân viên thiết kế đồ hoạ',
            'Nhân viên lương/ bảo hiểm', 'Nhân viên pháp lý', 'Nhân viên cứu hộ'
        ];

        $customer_roles = [
            'Khách hàng', 'Khách hàng ưu đãi', 'Khách hàng VIP'
        ];

        for ($i = 0; $i < count($admin_roles); $i++) {
            Role::factory()->create([
                'role_name' => $admin_roles[$i],
                'role_type' => 'ROLE_ADMIN',
            ]);
        }

        for ($i = 0; $i < count($employee_roles); $i++) {
            Role::factory()->create([
                'role_name' => $employee_roles[$i],
                'role_type' => 'ROLE_EMPLOYEE',
            ]);
        }

        for ($i = 0; $i < count($customer_roles); $i++) {
            Role::factory()->create([
                'role_name' => $customer_roles[$i],
                'role_type' => 'ROLE_CUSTOMER',
            ]);
        }
    }
}
