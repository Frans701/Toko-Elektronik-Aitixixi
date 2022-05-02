<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['courier' => 'jne'],
            ['courier' => 'pos'],
            ['courier' => 'tiki'],
        ];
        Courier::insert($data);
    }
}
