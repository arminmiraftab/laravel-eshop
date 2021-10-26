<?php

use App\colormodel;
use Illuminate\Database\Seeder;

class colorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        colormodel::insert([
            'color_name' => 'ابی',

        ]);

    }
}
