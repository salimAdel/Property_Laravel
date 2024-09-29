<?php

namespace Database\Seeders;

use App\Models\OfferType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        OfferType::create([
            'name'=>'عقارات للبيع'
        ]);
        OfferType::create([
            'name'=>'عقارات للإيجار'
        ]);
        OfferType::create([
            'name'=>'منتزهات عائلية'
        ]);
    }
}
