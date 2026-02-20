<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@test.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password')
            ]
        );

        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password')
            ]
        );

        $doctor = User::firstOrCreate(
            ['email' => 'doctor@test.com'],
            [
                'name' => 'Doctor',
                'password' => bcrypt('password')
            ]
        );

        $registerer = User::firstOrCreate(
            ['email' => 'registerer@test.com'],
            [
                'name' => 'Registerer',
                'password' => bcrypt('password')
            ]
        );

        $superAdmin->assignRole('super_admin');
        $admin->assignRole('admin');
        $doctor->assignRole('doctor');
        $registerer->assignRole('registerer');
    }
}
