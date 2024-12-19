<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Country::create([
            'code' => 'PS',
            'currency_id' => (Currency::first())->id,
            'name_en' => 'Pals',
            'name_ar' => 'فلسطين',
            'longitude' => '12312313',
            'latitude' => '123123123',
            'active' => true
        ]);
    }
}
