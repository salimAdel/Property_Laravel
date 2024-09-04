<?php

namespace Database\Seeders;

use App\Models\Privilege;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Privilege::create([
           'name' => 'ادارة الصلاحيات',
        ]);
        Privilege::create([
            'name' => 'ادارة المستخدمين',
        ]);
        Privilege::create([
            'name' => 'ادارة المكاتب',
        ]);
        Privilege::create([
            'name' => 'ادارة العروض العقارية',
        ]);
        Privilege::create([
            'name' => 'ادارة الأملاك',
        ]);
        Privilege::create([
            'name' => 'تقييم العقارات',
        ]);
        Privilege::create([
            'name' => 'ادارة الشركاء',
        ]);
        Privilege::create([
            'name' => 'ادارة الأعلانات',
        ]);
        Privilege::create([
            'name' => 'ادارة معلومات التطبيق',
        ]);
    }
}
