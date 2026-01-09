<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'Admin3',
                'password' => Hash::make('123456'),
                'nama_lengkap' => 'administrator',
                'email' => 'admin@gmail.com',
                'no_telp' => '0911',
                'id_session' => 'unit1',
            ]
        ]);
    }
}