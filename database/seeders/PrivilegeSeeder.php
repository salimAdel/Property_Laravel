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
            'en_name'=> 'Manage Permissions'
        ]);
        Privilege::create([
            'name' => 'ادارة المستخدمين',
            'en_name'=> 'User Management'
        ]);
        Privilege::create([
            'name' => 'ادارة المكاتب',
            'en_name'=> 'Office Management'
        ]);
        Privilege::create([
            'name' => 'ادارة العروض العقارية',
            'en_name'=> 'Real Estate Offers Management'
        ]);
        Privilege::create([
            'name' => 'ادارة الأملاك',
            'en_name'=> 'Property Management'
        ]);
        Privilege::create([
            'name' => 'تقييم العقارات',
            'en_name'=> 'Real Estate Valuation'
        ]);
        Privilege::create([
            'name' => 'ادارة الشركاء',
            'en_name'=> 'Partner Management'
        ]);
        Privilege::create([
            'name' => 'ادارة الأعلانات',
            'en_name'=> 'Advertising Management'
        ]);
        Privilege::create([
            'name' => 'ادارة معلومات التطبيق',
            'en_name'=> 'Application Information Management'
        ]);
    }
}
