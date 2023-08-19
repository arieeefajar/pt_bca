<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'super admin', 'email' => 'superadmin@gmail.com', 'password' => Hash::make('12345678'), 'alamat' => 'polije', 'no_telp' => '081233764580', 'role' => 'supper-admin'],
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('12345678'), 'alamat' => 'polije', 'no_telp' => '081233764580', 'role' => 'admin'],
            ['name' => 'executive', 'email' => 'executive@gmail.com', 'password' => Hash::make('12345678'), 'alamat' => 'polije', 'no_telp' => '081233764580', 'role' => 'executive'],
            ['name' => 'surveyor', 'email' => 'surveyor@gmail.com', 'password' => Hash::make('12345678'), 'alamat' => 'polije', 'no_telp' => '081233764580', 'role' => 'user']
        ];

        foreach ($data as $value) {
            User::create([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => $value['password'],
                'alamat' => $value['alamat'],
                'no_telp' => $value['no_telp'],
                'role' => $value['role'],
            ]);
        }
    }
}
