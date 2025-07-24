<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission untuk mengelola users
        Permission::updateOrCreate(['name' => 'show users']);
        Permission::updateOrCreate(['name' => 'add users']);
        Permission::updateOrCreate(['name' => 'edit users']);
        Permission::updateOrCreate(['name' => 'delete users']);

        // Permission untuk mengelola roles
        Permission::updateOrCreate(['name' => 'show roles']);
        Permission::updateOrCreate(['name' => 'add roles']);
        Permission::updateOrCreate(['name' => 'edit roles']);
        Permission::updateOrCreate(['name' => 'delete roles']);

      
      // Permission untuk mengelola barangs
        Permission::updateOrCreate(['name' => 'show barangs']);
        Permission::updateOrCreate(['name' => 'add barangs']);
        Permission::updateOrCreate(['name' => 'edit barangs']);
        Permission::updateOrCreate(['name' => 'delete barangs']);

        // Permission untuk mengelola Suplier
        Permission::updateOrCreate(['name' => 'show supliers']);
        Permission::updateOrCreate(['name' => 'add supliers']);
        Permission::updateOrCreate(['name' => 'edit supliers']);
        Permission::updateOrCreate(['name' => 'delete supliers']);

        

        // Permission untuk mengelola kategoris
        Permission::updateOrCreate(['name' => 'show kategoris']);
        Permission::updateOrCreate(['name' => 'add kategoris']);
        Permission::updateOrCreate(['name' => 'edit kategoris']);
        Permission::updateOrCreate(['name' => 'delete kategoris']);

    
        Permission::updateOrCreate(['name' => 'show customers']);
        Permission::updateOrCreate(['name' => 'add customers']);
        Permission::updateOrCreate(['name' => 'edit customers']);
        Permission::updateOrCreate(['name' => 'delete customers']);

        // Permission untuk mengelola stok_masuks
        Permission::updateOrCreate(['name' => 'show stock_masuks']);
        Permission::updateOrCreate(['name' => 'add stock_masuks']);
        Permission::updateOrCreate(['name' => 'edit stock_masuks']);
        Permission::updateOrCreate(['name' => 'delete stock_masuks']);
        
        // Permission untuk mengelola stok_keluars
        Permission::updateOrCreate(['name' => 'show stock_keluars']);
        Permission::updateOrCreate(['name' => 'add stock_keluars']);
        Permission::updateOrCreate(['name' => 'edit stock_keluars']);
        Permission::updateOrCreate(['name' => 'delete stock_keluars']);
                
        // Permission tambahan
        Permission::updateOrCreate(['name' => 'manage-hr']);
        Permission::updateOrCreate(['name' => 'manage-barangs']);
        Permission::updateOrCreate(['name' => 'manage-users']);
        Permission::updateOrCreate(['name' => 'manage-roles']);
        Permission::updateOrCreate(['name' => 'manage-customers']);
        Permission::updateOrCreate(['name' => 'manage-supliers']);
        Permission::updateOrCreate(['name' => 'manage-kategoris']);
    }
}
