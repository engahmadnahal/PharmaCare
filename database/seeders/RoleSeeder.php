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
        //
        // $allStorePer = Permission::where('guard_name', 'store')->get();
        $allAdminPer = Permission::where('guard_name', 'admin')->get();
        $allStudioPer = Permission::where('guard_name', 'studio')->get();
        $allStudioBranchPer = Permission::where('guard_name', 'studiobranch')->get();
        Role::create(['name' => 'Super-Admin', 'guard_name' => 'admin'])->givePermissionTo($allAdminPer);
        Role::create(['name' => 'Studio', 'guard_name' => 'studio'])->givePermissionTo($allStudioPer);
        Role::create(['name' => 'Studio-Branch', 'guard_name' => 'studiobranch'])->givePermissionTo($allStudioBranchPer);
    }
}
