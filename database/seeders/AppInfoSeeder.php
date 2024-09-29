<?php

namespace Database\Seeders;

use App\Models\AppInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AppInfo::create([
            'about_us' =>'',
            'policy'=>''
        ]);
    }
}
