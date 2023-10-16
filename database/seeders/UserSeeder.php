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
            [
                'name' => 'super admin',
                'nip' => 'super-admin',
                'password' => Hash::make('super-admin'),
                'role' => 'supper-admin',
            ],
            [
                'name' => 'admin',
                'nip' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ],
            [
                'name' => 'executive',
                'nip' => 'executive',
                'password' => Hash::make('executive'),
                'role' => 'executive',
            ],
            [
                'name' => 'Polije',
                'nip' => 'mfpolije',
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ],
        ];

        foreach ($data as $value) {
            User::create([
                'name' => $value['name'],
                'nip' => $value['nip'],
                'password' => $value['password'],
                'role' => $value['role'],
            ]);
        }

        $pathJson = base_path('database/seeders/dataJson/pegawai.json');
        $readJson = file_get_contents($pathJson);
        $jsonData = [json_decode($readJson, true)];

        foreach ($jsonData[0]['employees'] as $user) {
            User::create([
                'name' => $user['Name'],
                'nip' => $user['NIP'],
                'position' => $user['Position'],
                'password' => Hash::make($user['NIP']),
                'role' => 'user',
            ]);
        }
    }
}
