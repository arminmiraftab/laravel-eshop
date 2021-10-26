<?php

use App\image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        image::insert([
            'images_id' => 1,
            'images_type' => 'App\products',
            'imageable_path' => 'image/ijpEXLEz8Eay11K25tPR.jpg',
            'imageable_alt' => 'gf',
            'first_photo' => 1,


        ]);
        image::insert([
            'images_id' => 2,
            'images_type' => 'App\products',
            'imageable_path' => 'image/0ebDk6kl3mtECB0VK7Dr.jpg',
            'imageable_alt' => 'gf',
            'first_photo' => 1,


        ]);
        image::insert([
            'images_id' => 3,
            'images_type' => 'App\products',
            'imageable_path' => 'image/GnLJ9VdgCXzTcM2VmAVn.jpg',
            'imageable_alt' => 'gf',
            'first_photo' => 1,


        ]);
        image::insert([
            'images_id' => 4,
            'images_type' => 'App\products',
            'imageable_path' => 'image/ngmDBE1YA8qhGkqvOWzL.jpg',
            'imageable_alt' => 'gf',
            'first_photo' => 1,


        ]);
        image::insert([
            'images_id' => 1,
            'images_type' => 'App\sliders',
            'imageable_path' => 'image/slider/zCuNDelrLva47jRvvECS.jpg',
            'imageable_alt' => 'gf',
            'first_photo' => 1,


        ]);
        image::insert([
            'images_id' => 2,
            'images_type' => 'App\sliders',
            'imageable_path' => 'image/ngmDBE1YA8qhGkqvOWzL.jpg',
            'imageable_alt' => 'gf',


        ]);
        image::insert([
            'images_id' => 3,
            'images_type' => 'App\sliders',
            'imageable_path' => 'image/slider/HSxT0pcfg1CkLobT2Sjy.jpg',
            'imageable_alt' => 'gf',


        ]);
        image::insert([
            'images_id' => 4,
            'images_type' => 'App\sliders',
            'imageable_path' => 'image/slider/WW8I3mccvAP6ctp1GT4H.jpg',
            'imageable_alt' => 'gf',


        ]);






    }
}
