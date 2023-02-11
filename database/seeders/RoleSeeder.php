<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $superAdmin = Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'writer']);
        Role::create(['name' => 'user']);

        $permissions = [
            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'Roles',
                'permissions' => [
                    'roles.list',
                    'roles.view',
                    'roles.create',
                    'roles.edit',
                    'roles.delete',
                    'roles.approve',
                ]
            ],
            [
                'group_name' => 'Permission',
                'permissions' => [
                    'permission.list',
                    'permission.view',
                    'permission.edit',
                    'permission.delete',
                    'permission.create',
                    'permission.approve',
                ]
            ],
            [
                'group_name' => 'User',
                'permissions' => [
                    'user.list',
                    'user.view',
                    'user.edit',
                    'user.delete',
                    'user.create',
                    'user.approve',
                ]
            ],
            [
                'group_name' => 'Profile',
                'permissions' => [
                    'profile.view',
                    'profile.edit',
                    'profile.delete',
                ]
            ],

        ];

        for ($i = 0;$i<count($permissions);$i++){
            $permissions_group = $permissions[$i]['group_name'];
            for ($j = 0;$j<count($permissions[$i]['permissions']);$j++){
                $permission =  Permission::create(['name'=>$permissions[$i]['permissions'][$j],'group_name'=>$permissions_group]);
                $superAdmin->givePermissionTo($permission);
                $permission->assignRole($superAdmin);
            }

        }
    }
}
