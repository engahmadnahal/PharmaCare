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

        // Permission::create(['name' => 'Create-Product', 'guard_name' => 'admin']); //
        // Permission::create(['name' => 'Update-Product', 'guard_name' => 'admin']); //
        // Permission::create(['name' => 'Delete-Product', 'guard_name' => 'admin']); //
        // Permission::create(['name' => 'Read-Products', 'guard_name' => 'admin']); //

        // Permission::create(['name' => 'Update-ContactUs', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-ContactUs', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-ContactUs', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-FCM', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-FCM', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-FCM', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-FCM', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-PromoCode', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-PromoCodes', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-PromoCode', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-PromoCode', 'guard_name' => 'admin']);

        //  Permission::create(['name' => 'Create-OrderSoftcopy', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-OrderSoftcopy', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-OrderSoftcopy', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-OrderSoftcopy', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-QsOrder', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-QsOrder', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-QsOrder', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-QsOrder', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Order', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Order', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Order', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Order', 'guard_name' => 'admin']);
        

        


        // Permission::create(['name' => 'OrderList-StudioBranch', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Block-StudioBranch', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-StudioBranch', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-StudioBranch', 'guard_name' => 'admin']);
        
        // Permission::create(['name' => 'Create-Currency', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Currency', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Currency', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Currency', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-SoftCopyService', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-SoftCopyService', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-SoftCopyService', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-SoftCopyService', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-BookingStudioService', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-BookingStudioService', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-BookingStudioService', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-BookingStudioService', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-FrameAlbum', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-FrameAlbum', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-FrameAlbum', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-FrameAlbum', 'guard_name' => 'admin']);
        
        // Permission::create(['name' => 'Create-Passport', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Passport', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Passport', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Passport', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Poster', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Poster', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Poster', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Poster', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Postcard', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Postcard', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Postcard', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Postcard', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-Term', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Term', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Term', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Term', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Privacy', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Privacy', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Privacy', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Privacy', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'AcceptStudio', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-Delivary', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Read-Delivary', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Delivary', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Delivary', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-StoreHouse', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-StoreHouse', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-StoreHouse', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-StoreHouse', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Studio', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Studio', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Studio', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Studio', 'guard_name' => 'admin']);

        

        // Permission::create(['name' => 'Create-ServiceStudio', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-ServiceStudio', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-ServiceStudio', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-ServiceStudio', 'guard_name' => 'admin']);


        

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

        // Permission::create(['name' => 'Read-User', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-FAQ', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-FAQs', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-FAQ', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-FAQ', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Country', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Countries', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Country', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Country', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-City', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Cities', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-City', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-City', 'guard_name' => 'admin']);



        // Permission::create(['name' => 'Create-Ads', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Ads', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Ads', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Ads', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-About', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-About', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-About', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-About', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Payment', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Payments', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Payment', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Payment', 'guard_name' => 'admin']);




        // Permission::create(['name' => 'Create-Region', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Regions', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Region', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Region', 'guard_name' => 'admin']);
        

        // // // =========== Studio
        // Permission::create(['name' => 'Create-Order', 'guard_name' => 'studio']);
        // Permission::create(['name' => 'Update-Order', 'guard_name' => 'studio']);
        // Permission::create(['name' => 'Delete-Order', 'guard_name' => 'studio']);
        // Permission::create(['name' => 'Read-Order', 'guard_name' => 'studio']);

        // Permission::create(['name' => 'Create-StudioBranch', 'guard_name' => 'studio']);
        // Permission::create(['name' => 'Read-StudioBranch', 'guard_name' => 'studio']);
        // Permission::create(['name' => 'Update-StudioBranch', 'guard_name' => 'studio']);
        // Permission::create(['name' => 'Delete-StudioBranch', 'guard_name' => 'studio']);

        // // // =========== Studio Branch

        // Permission::create(['name' => 'Read-MyProducts', 'guard_name' => 'studiobranch']); //
        // Permission::create(['name' => 'Read-Products', 'guard_name' => 'studiobranch']);
        

        // Permission::create(['name' => 'Change-StatusOrder', 'guard_name' => 'studiobranch']);//
        // Permission::create(['name' => 'Create-Order', 'guard_name' => 'studiobranch']);
        // Permission::create(['name' => 'Read-Order', 'guard_name' => 'studiobranch']);
        // Permission::create(['name' => 'Update-Order', 'guard_name' => 'studiobranch']);
        // Permission::create(['name' => 'Delete-Order', 'guard_name' => 'studiobranch']);

        // Permission::create(['name' => 'Read-Delivary', 'guard_name' => 'studiobranch']);

        // Permission::create(['name' => 'Create-BookingStudio', 'guard_name' => 'studiobranch']);
        // Permission::create(['name' => 'Read-BookingStudio', 'guard_name' => 'studiobranch']);
        // Permission::create(['name' => 'Update-BookingStudio', 'guard_name' => 'studiobranch']);
        // Permission::create(['name' => 'Delete-BookingStudio', 'guard_name' => 'studiobranch']);

        // Permission::create(['name' => 'Read-ServicesBookinStudio', 'guard_name' => 'studiobranch']);

        Permission::create(['name' => 'Create-Report', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Report', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Report', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Report', 'guard_name' => 'admin']);


        $allAdminPer = Permission::where('guard_name', 'admin')->get();
        (Role::where('name','Super-Admin')->first())->givePermissionTo($allAdminPer);
        
    }
}
