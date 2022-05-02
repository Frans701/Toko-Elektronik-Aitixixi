<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();//kosongkan table

        $key = '8580f5686e5a3eeab330119f3d82e31e'; //Buat akun atau pakai API akun Tahu Coding
        $city_url = 'https://api.rajaongkir.com/starter/city';

        //logic untuk get province and city
        $getCities = $this->getData($key,$city_url);
        $cities = $getCities['rajaongkir']['results'];

        foreach($cities as $city){
            $data[] = [
                'id' => $city['city_id'],
                'city_name' => $city['city_name'],
                'province_id' => $city['province_id'],
                'type' => $city['type'],
                'postal_code' => $city['postal_code'],
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        City::insert($data);
    }

     //function untuk get data province and city
    private function getData($key,$url){
        return Http::withHeaders([
            'key' => $key
        ])->get($url);
    }
}
