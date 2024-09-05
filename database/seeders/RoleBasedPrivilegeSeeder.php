<?php

namespace Database\Seeders;

use App\Models\RoleBasedPrivilege;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleBasedPrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //This for Super Admin
        RoleBasedPrivilege::create([
            'is_displayed' => 1,
            'is_insert' => 1,
            'is_update' => 1,
            'is_delete' => 1,
            'role_id' => 1,
            'privilege_id' => 1,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 1,
            'is_insert' => 1,
            'is_update' => 1,
            'is_delete' => 1,
            'role_id' => 1,
            'privilege_id' => 2,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 1,
            'is_insert' => 1,
            'is_update' => 1,
            'is_delete' => 1,
            'role_id' => 1,
            'privilege_id' => 3,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 1,
            'is_insert' => 1,
            'is_update' => 1,
            'is_delete' => 1,
            'role_id' => 1,
            'privilege_id' => 4,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 1,
            'is_insert' => 1,
            'is_update' => 1,
            'is_delete' => 1,
            'role_id' => 1,
            'privilege_id' => 5,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 1,
            'is_insert' => 1,
            'is_update' => 1,
            'is_delete' => 1,
            'role_id' => 1,
            'privilege_id' => 6,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 1,
            'is_insert' => 1,
            'is_update' => 1,
            'is_delete' => 1,
            'role_id' => 1,
            'privilege_id' => 7,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 1,
            'is_insert' => 1,
            'is_update' => 1,
            'is_delete' => 1,
            'role_id' => 1,
            'privilege_id' => 8,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 1,
            'is_insert' => 1,
            'is_update' => 1,
            'is_delete' => 1,
            'role_id' => 1,
            'privilege_id' => 9,
        ]);



        //This for Client
        RoleBasedPrivilege::create([
            'is_displayed' => 0,
            'is_insert' => 0,
            'is_update' => 0,
            'is_delete' => 0,
            'role_id' => 2,
            'privilege_id' => 1,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 0,
            'is_insert' => 0,
            'is_update' => 0,
            'is_delete' => 0,
            'role_id' => 2,
            'privilege_id' => 2,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 0,
            'is_insert' => 0,
            'is_update' => 0,
            'is_delete' => 0,
            'role_id' => 2,
            'privilege_id' => 3,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 0,
            'is_insert' => 0,
            'is_update' => 0,
            'is_delete' => 0,
            'role_id' => 2,
            'privilege_id' => 4,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 0,
            'is_insert' => 0,
            'is_update' => 0,
            'is_delete' => 0,
            'role_id' => 2,
            'privilege_id' => 5,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 0,
            'is_insert' => 0,
            'is_update' => 0,
            'is_delete' => 0,
            'role_id' => 2,
            'privilege_id' => 6,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 0,
            'is_insert' => 0,
            'is_update' => 0,
            'is_delete' => 0,
            'role_id' => 2,
            'privilege_id' => 7,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 0,
            'is_insert' => 0,
            'is_update' => 0,
            'is_delete' => 0,
            'role_id' => 2,
            'privilege_id' => 8,
        ]);
        RoleBasedPrivilege::create([
            'is_displayed' => 0,
            'is_insert' => 0,
            'is_update' => 0,
            'is_delete' => 0,
            'role_id' => 2,
            'privilege_id' => 9,
        ]);
    }
}
