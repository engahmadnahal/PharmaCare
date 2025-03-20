<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        // Permission::create(['name' => 'Create-Setting', 'guard_name' => 'admin']); //
        // Permission::create(['name' => 'Read-Setting', 'guard_name' => 'admin']); //

        // Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']); //
        // Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']); //
        // Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']); //
        // Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']); //

        // Permission::create(['name' => 'Create-Order', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Order', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Order', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Order', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-Currency', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Currency', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Currency', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Currency', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Permission', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Country', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Countries', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Country', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Country', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-City', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Cities', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-City', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-City', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-About', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-About', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-About', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-About', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-Region', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Regions', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Region', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Region', 'guard_name' => 'admin']);



        // Permission::create(['name' => 'Create-Report', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Report', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Report', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Report', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Employee', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Employee', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Employee', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Employee', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Pharma', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Pharma', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Pharma', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Pharma', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Category', 'guard_name' => 'admin']);



        // Permission::create(['name' => 'Create-Employee-Product', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Read-Employee-Product', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Update-Employee-Product', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Delete-Employee-Product', 'guard_name' => 'employee']);

        // Permission::create(['name' => 'Create-Employee-User', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Read-Employee-User', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Update-Employee-User', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Delete-Employee-User', 'guard_name' => 'employee']);

        // Permission::create(['name' => 'Create-Employee-Employee', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Read-Employee-Employee', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Update-Employee-Employee', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Delete-Employee-Employee', 'guard_name' => 'employee']);

        // Permission::create(['name' => 'Create-Employee-Role', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Read-Employee-Role', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Update-Employee-Role', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Delete-Employee-Role', 'guard_name' => 'employee']);

        // Permission::create(['name' => 'Create-Employee-Order', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Read-Employee-Order', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Update-Employee-Order', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Delete-Employee-Order', 'guard_name' => 'employee']);


        // Permission::create(['name' => 'Read-Employee-Analytics', 'guard_name' => 'employee']);

        // Permission::create(['name' => 'Create-Employee-Coupon', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Read-Employee-Coupon', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Update-Employee-Coupon', 'guard_name' => 'employee']);
        // Permission::create(['name' => 'Delete-Employee-Coupon', 'guard_name' => 'employee']);


        $allAdminPer = Permission::where('guard_name', 'admin')->get();
        $role = Role::where('name', 'Super-Admin')->first();
        if ($role) {
            $role->givePermissionTo($allAdminPer);
        }

        $allEmployeePer = Permission::where('guard_name', 'employee')->get();
        $role = Role::where('name', 'Employee')->first();
        if ($role) {
            $role->givePermissionTo($allEmployeePer);
        }
    }
}
