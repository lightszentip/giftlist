<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'name' => 'Admin',
            'email' => 'noreply@pleasereplacethisdomainemail.com',
            'password' => Hash::make('secret'),
        ]);
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleSupport = Role::create(['name' => 'Support']);
        $roleGuest = Role::create(['name' => 'Guest']);
        $permissionCreate = Permission::create(['name' => 'createPresent']);
        $permissionRelease = Permission::create(['name' => 'releasePresent']);
        $permissionReset = Permission::create(['name' => 'resetPresent']);
        $permissionSelect = Permission::create(['name' => 'selectPresent']);
        $permissionDelete = Permission::create(['name' => 'deletePresent']);
        $permissionUser = Permission::create(['name' => 'user']);
        $permissionCreate->assignRole($roleSupport);
        $permissionCreate->assignRole($roleAdmin);
        $permissionRelease->assignRole($roleAdmin);
        $permissionRelease->assignRole($roleSupport);
        $permissionReset->assignRole($roleAdmin);
        $permissionSelect->assignRole($roleGuest);
        $permissionSelect->assignRole($roleSupport);
        $permissionSelect->assignRole($roleAdmin);
        $permissionDelete->assignRole($roleAdmin);
        $permissionUser->assignRole($roleAdmin);
        $user->assignRole([$roleAdmin->id]);
    }
}
