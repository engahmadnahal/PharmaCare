<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allAdminPer = Permission::where('guard_name', 'admin')->get();
        $allEmployeePer = Permission::where('guard_name', 'employee')->get();

        Role::create(['name' => 'Super-Admin', 'guard_name' => 'admin'])->givePermissionTo($allAdminPer);
        Role::create(['name' => 'Employee', 'guard_name' => 'employee'])->givePermissionTo($allEmployeePer);
    }
}
