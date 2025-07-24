<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat role admin dan operator
        $super_admin = Role::updateOrCreate(['name' => 'Super Admin']);
        $admin = Role::updateOrCreate(['name' => 'Admin']);

        // Memberikan semua permission kepada role admin
        $super_admin->givePermissionTo(Permission::all());

        // Memberikan permission tertentu kepada role operator
        $admin->givePermissionTo(['show users', 'add barangs', 'edit barangs', 'delete barangs','show barangs',
        'add supliers', 'edit supliers', 'delete supliers','show supliers', 'add stock_masuks', 'edit stock_masuks', 'delete stock_masuks','show stock_masuks'
        ,'add stock_keluars', 'edit stock_keluars', 'delete stock_keluars','show stock_keluars']);
    }
}
