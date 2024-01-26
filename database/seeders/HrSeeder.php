<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'hr']);

        Permission::create(['name' => 'view-plant']);
        Permission::create(['name' => 'create-plant']);
        Permission::create(['name' => 'update-plant']);
        Permission::create(['name' => 'delete-plant']);

        Permission::create(['name' => 'view-job']);
        Permission::create(['name' => 'create-job']);
        Permission::create(['name' => 'update-job']);
        Permission::create(['name' => 'delete-job']);
    }
}
