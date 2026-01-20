<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $writer = Role::create(['name' => 'writer']);
        $editBooksPermission = Permission::create(['name' => 'edit books']);
        $editAuthorsPermission = Permission::create(['name' => 'edit authors']);

        $writer->givePermissionTo($editBooksPermission);
        $admin->givePermissionTo($editAuthorsPermission, $editBooksPermission);
    }
}
