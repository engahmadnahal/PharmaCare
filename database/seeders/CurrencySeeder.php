<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name_ar' => 'دينار',
            'name_en' => 'Dinar',
            'code' => 'JD' 
        ]);

        Currency::create([
            'name_ar' => 'دولار',
            'name_en' => 'dollar',
            'code' => 'USD' 
        ]);

        Currency::create([
            'name_ar' => 'يورو',
            'name_en' => 'EURO',
            'code' => 'ERU' 
        ]);

        Currency::create([
            'name_ar' => 'درهم اماراتي',
            'name_en' => 'UEA',
            'code' => 'UAE' 
        ]);
    }
}
