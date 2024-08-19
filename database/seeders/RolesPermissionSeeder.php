<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdmin = User::where('email', 'admin@admin.com')->first();

        $roles = [
            'Super Admin',
            'Property Group Admin',
            'Property Admin',
            'System Admin',
            'Admin',
            'Staff',
        ];

        foreach ($roles as $role) {
            $has_roles = Role::where(['name'=>$role])->first();
            if(!isset($has_roles)) {
                Role::create(['name' => $role]);
            }
        }

        $superAdmin->syncRoles('Super Admin');

        $permission_array = [

            ['section_name' => 'dashboard', 'name' => 'property.view'],

            ['section_name' => 'admin-dashboard', 'name' => 'admin-dashboard.view'],
            ['section_name' => 'property-dashboard', 'name' => 'property-dashboard.view'],

            ['section_name' => 'media', 'name' => 'media.view'],
            ['section_name' => 'media', 'name' => 'media.create'],
            ['section_name' => 'media', 'name' => 'media.edit'],
            ['section_name' => 'media', 'name' => 'media.delete'],

            ['section_name' => 'property', 'name' => 'property.view'],
            ['section_name' => 'property', 'name' => 'property.create'],
            ['section_name' => 'property', 'name' => 'property.edit'],
            ['section_name' => 'property', 'name' => 'property.delete'],

            ['section_name' => 'partner', 'name' => 'partner.view'],
            ['section_name' => 'partner', 'name' => 'partner.create'],
            ['section_name' => 'partner', 'name' => 'partner.edit'],
            ['section_name' => 'partner', 'name' => 'partner.delete'],

            ['section_name' => 'booking', 'name' => 'booking.view'],
            ['section_name' => 'booking', 'name' => 'booking.create'],
            ['section_name' => 'booking', 'name' => 'booking.edit'],
            ['section_name' => 'booking', 'name' => 'booking.delete'],

           
          


            ['section_name' => 'meal-type', 'name' => 'meal-type.view'],
            ['section_name' => 'meal-type', 'name' => 'meal-type.create'],
            ['section_name' => 'meal-type', 'name' => 'meal-type.edit'],
            ['section_name' => 'meal-type', 'name' => 'meal-type.delete'],

            ['section_name' => 'bed-type', 'name' => 'bed-type.view'],
            ['section_name' => 'bed-type', 'name' => 'bed-type.create'],
            ['section_name' => 'bed-type', 'name' => 'bed-type.edit'],
            ['section_name' => 'bed-type', 'name' => 'bed-type.delete'],

            ['section_name' => 'activity', 'name' => 'activity.view'],
            ['section_name' => 'activity', 'name' => 'activity.create'],
            ['section_name' => 'activity', 'name' => 'activity.edit'],
            ['section_name' => 'activity', 'name' => 'activity.delete'],
            
            ['section_name' => 'property-type', 'name' => 'property-type.view'],
            ['section_name' => 'property-type', 'name' => 'property-type.create'],
            ['section_name' => 'property-type', 'name' => 'property-type.edit'],
            ['section_name' => 'property-type', 'name' => 'property-type.delete'],

            ['section_name' => 'destination', 'name' => 'destination.view'],
            ['section_name' => 'destination', 'name' => 'destination.create'],
            ['section_name' => 'destination', 'name' => 'destination.edit'],
            ['section_name' => 'destination', 'name' => 'destination.delete'],

            ['section_name' => 'destination-feature', 'name' => 'destination-feature.view'],
            ['section_name' => 'destination-feature', 'name' => 'destination-feature.create'],
            ['section_name' => 'destination-feature', 'name' => 'destination-feature.edit'],
            ['section_name' => 'destination-feature', 'name' => 'destination-feature.delete'],

            ['section_name' => 'hotel-policy', 'name' => 'hotel-policy.view'],
            ['section_name' => 'hotel-policy', 'name' => 'hotel-policy.create'],
            ['section_name' => 'hotel-policy', 'name' => 'hotel-policy.edit'],
            ['section_name' => 'hotel-policy', 'name' => 'hotel-policy.delete'],

            ['section_name' => 'backend-user', 'name' => 'backend-user.view'],
            ['section_name' => 'backend-user', 'name' => 'backend-user.create'],
            ['section_name' => 'backend-user', 'name' => 'backend-user.edit'],
            ['section_name' => 'backend-user', 'name' => 'backend-user.delete'],

            ['section_name' => 'roles-permissions', 'name' => 'roles-permissions.view'],
            ['section_name' => 'roles-permissions', 'name' => 'roles-permissions.create'],
            ['section_name' => 'roles-permissions', 'name' => 'roles-permissions.edit'],
            ['section_name' => 'roles-permissions', 'name' => 'roles-permissions.delete'],

            ['section_name' => 'system-setting', 'name' => 'system-setting.view'],
            ['section_name' => 'system-setting', 'name' => 'system-setting.create'],
            ['section_name' => 'system-setting', 'name' => 'system-setting.edit'],
            ['section_name' => 'system-setting', 'name' => 'system-setting.delete'],

            

            // property permissions

            ['section_name' => 'room', 'name' => 'room.view'],
            ['section_name' => 'room', 'name' => 'room.create'],
            ['section_name' => 'room', 'name' => 'room.edit'],
            ['section_name' => 'room', 'name' => 'room.delete'],

            ['section_name' => 'offer', 'name' => 'offers.view'],
            ['section_name' => 'offer', 'name' => 'offers.create'],
            ['section_name' => 'offer', 'name' => 'offers.edit'],
            ['section_name' => 'offer', 'name' => 'offers.delete'],

            ['section_name' => 'rate', 'name' => 'rate.view'],
            ['section_name' => 'rate', 'name' => 'rate.create'],
            ['section_name' => 'rate', 'name' => 'rate.edit'],
            ['section_name' => 'rate', 'name' => 'rate.delete'],

            ['section_name' => 'amenitiy', 'name' => 'amenitiy.view'],
            ['section_name' => 'amenitiy', 'name' => 'amenitiy.create'],
            ['section_name' => 'amenitiy', 'name' => 'amenitiy.edit'],
            ['section_name' => 'amenitiy', 'name' => 'amenitiy.delete'],
            
            ['section_name' => 'facility', 'name' => 'facility.view'],
            ['section_name' => 'facility', 'name' => 'facility.create'],
            ['section_name' => 'facility', 'name' => 'facility.edit'],
            ['section_name' => 'facility', 'name' => 'facility.delete'],

            ['section_name' => 'career', 'name' => 'career.view'],
            ['section_name' => 'career', 'name' => 'career.create'],
            ['section_name' => 'career', 'name' => 'career.edit'],
            ['section_name' => 'career', 'name' => 'career.delete'],
            
            ['section_name' => 'blogs', 'name' => 'blog.view'],
            ['section_name' => 'blogs', 'name' => 'blog.create'],
            ['section_name' => 'blogs', 'name' => 'blog.edit'],
            ['section_name' => 'blogs', 'name' => 'blog.delete'],

            ['section_name' => 'operators', 'name' => 'operator.view'],
            ['section_name' => 'operators', 'name' => 'operator.create'],
            ['section_name' => 'operators', 'name' => 'operator.edit'],
            ['section_name' => 'operators', 'name' => 'operator.delete'],
            ['section_name' => 'bookingforcast', 'name' => 'bookingforcast.view'],

            ['section_name' => 'allotments', 'name' => 'allotments.view'],
            ['section_name' => 'allotments', 'name' => 'allotments.create'],
            ['section_name' => 'allotments', 'name' => 'allotments.edit'],
            ['section_name' => 'allotments', 'name' => 'allotments.delete'],

            ['section_name' => 'currencies', 'name' => 'currencies.view'],
            ['section_name' => 'currencies', 'name' => 'currencies.create'],
            ['section_name' => 'currencies', 'name' => 'currencies.edit'],
            ['section_name' => 'currencies', 'name' => 'currencies.delete'],
            
        ];

        foreach ($permission_array as $permission) {

            $check_has_permission = Permission::where('name', $permission['name'])->first();
            if (!isset($check_has_permission)) {
                Permission::create($permission);
            }
        }
    }
}