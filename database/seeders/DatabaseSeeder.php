<?php

namespace Database\Seeders;

use App\Models\Admin;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
