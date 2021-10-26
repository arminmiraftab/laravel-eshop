<?php

use App\manufactures;
use Illuminate\Database\Seeder;

class manufactureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        manufactures::insert([
            'manufacture_name' => 'سامسونگ',
            'manufacture_description' => 'سامسونگ',
            'manufacture_status' => 1,
        ]);
        manufactures::insert([
            'manufacture_name' => 'نیکون',
            'manufacture_description' => 'نیکون',
            'manufacture_status' => 1,
        ]);
        manufactures::insert([
            'manufacture_name' => 'تبلت',
            'manufacture_description' => 'تبلت',
            'manufacture_status' => 1,
        ]);
        manufactures::insert([
            'manufacture_name' => 'اپل',
            'manufacture_description' => 'اپل',
            'manufacture_status' => 1,
        ]);
        manufactures::insert([
            'manufacture_name' => 'ال جی',
            'manufacture_description' => 'ال جی',
            'manufacture_status' => 1,
        ]);
        manufactures::insert([
            'manufacture_name' => 'شوینده',
            'manufacture_description' => ' شوینده',
            'manufacture_status' => 1,
        ]);

    }
}
