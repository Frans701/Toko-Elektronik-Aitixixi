<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\ProductCategories;
use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Admin::create([
            'admin_name' => 'Krisna Mahadiputra',
            'username' => 'admin_krisna',
            'password' => bcrypt('krisna123'),
            'admin_address' => 'Jl. Raya Padang Luwih',
            'phone' => '089681437135'
        ]);

        ProductCategories::create([
            'category_name' => 'kendaraan'
        ]);

        ProductCategories::create([
            'category_name' => 'makanan'
        ]);

        ProductCategories::create([
            'category_name' => 'minuman'
        ]);

        ProductCategories::create([
            'category_name' => 'pakaian'
        ]);

        ProductCategories::create([
            'category_name' => 'celana'
        ]);

        ProductCategories::create([
            'category_name' => 'prabotan'
        ]);

        // Products::factory(20)->create();
        $this->call(CouriersTableSeeder::class);
    }
}
