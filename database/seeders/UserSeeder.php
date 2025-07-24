<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nik' => 'NIK001',
                'email' => 'adi@email.com',
                'name' => 'Adi',
                'password' => Hash::make('password'),
                'tanggal' => '1990-01-01',
                'position' => 'Manager',
                'masuk_jadwal' => 'General',
                'kecelakaan' => 'Tidak Ada',
                'mulai_kerja' => '2020-06-15',
                'role' => 'super admin',
            ],
            [
                'nik' => 'NIK002',
                'email' => 'budi@email.com',
                'name' => 'Budi',
                'password' => Hash::make('password'),
                'tanggal' => '1985-05-10',
                'position' => 'Supervisor',
                'masuk_jadwal' => 'Shift',
                'kecelakaan' => 'Tidak ada',
                'mulai_kerja' => '2018-08-20',
                'role' => 'admin',
            ],
            [
                'nik' => 'NIK003',
                'email' => 'cindy@email.com',
                'name' => 'Cindy',
                'password' => Hash::make('password'),
                'tanggal' => '1992-09-25',
                'position' => 'Staff',
                'masuk_jadwal' => 'General',
                'kecelakaan' => 'Tidak ada',
                'mulai_kerja' => '2019-11-01',
                'role' => 'admin',
            ],
            [
                'nik' => 'NIK004',
                'email' => 'superadmin@email.com',
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'tanggal' => '1980-07-15',
                'position' => 'Owner',
                'masuk_jadwal' => 'General',
                'kecelakaan' => 'Tidak ada',
                'mulai_kerja' => '2010-01-01',
                'role' => 'super admin',
            ],
        ];

        foreach ($users as $userData) {
            $role = $userData['role'];
            unset($userData['role']); // Hapus role sebelum dimasukkan ke database

            $user = User::updateOrCreate([
                'nik' => $userData['nik'],
                'email' => $userData['email'],
            ], $userData);

            $user->assignRole($role);

            // Khusus untuk Cindy, berikan izin tambahan
            if ($role === 'admin' && $user->email === 'cindy@email.com') {
                $user->givePermissionTo('delete users');
            }
        }
    }
}
