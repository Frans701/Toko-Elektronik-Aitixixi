<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request; //new Laravel 7 HTTP Client
use Illuminate\Support\Facades\Http;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::truncate();//kosongkan table

        $key = '8580f5686e5a3eeab330119f3d82e31e'; //Buat akun atau pakai API akun Tahu Coding
        $province_url = 'https://api.rajaongkir.com/starter/province';

        //logic untuk get province and city
        $getProvinces = $this->getData($key,$province_url);
        $provinces = $getProvinces['rajaongkir']['results'];

        foreach($provinces as $province){
            $data[] = [
                'id' => $province['province_id'],
                'province' => $province['province'],
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        Province::insert($data);
    }

     //function untuk get data province and city
    private function getData($key,$url){
        return Http::withHeaders([
            'key' => $key
        ])->get($url);
    }
}
