<?php

use App\icons;
use Illuminate\Database\Seeder;

class iconsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        icons::insert([
            'icons_name' => 'fa fa-address-book',
            'icons_link' => 'South Dakota',
            'icons_color' => 'f',
            'icons_status' => 1,
        ]);

    }
}
