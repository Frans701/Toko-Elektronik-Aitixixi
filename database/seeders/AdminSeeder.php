<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'admin_name' => 'Krisna Mahadiputra',
            'username' => 'admin_krisna',
            'password' => Hash::make('krisna123'),
            'admin_address' => 'Jl. Raya Padang Luwih',
            'phone' => '089681437135'
        ]);
    }
}
