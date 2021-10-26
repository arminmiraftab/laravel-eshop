<?php

use App\sliders;
use Illuminate\Database\Seeder;

class sliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        sliders::insert([
            'slider_image' => 'image/slider/zCuNDelrLva47jRvvECS.jpg',
            'sub_category_slider' => 'Colorado',
            'category_slider' => 'Florida',
            'detal_slider' => 'Washington',
            'submit_slider' => 'Delaware',
            'submit_link' => 'https://www.google.com/',
            'slider_status' => 1,
        ]);
        sliders::insert([
            'slider_image' => 'image/slider/HSxT0pcfg1CkLobT2Sjy.jpg',
            'sub_category_slider' => 'Colorado',
            'category_slider' => 'Florida',
            'detal_slider' => 'Washington',
            'submit_slider' => 'Delaware',
            'submit_link' => 'https://www.google.com/',
            'slider_status' => 1,
        ]);
        sliders::insert([
            'slider_image' => 'image/slider/WW8I3mccvAP6ctp1GT4H.jpg',
            'sub_category_slider' => 'Colorado',
            'category_slider' => 'Florida',
            'detal_slider' => 'Washington',
            'submit_slider' => 'Delaware',
            'submit_link' => 'https://www.google.com/',
            'slider_status' => 1,
        ]);

    }
}
