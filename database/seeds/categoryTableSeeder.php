<?php

use App\categorys;
use Illuminate\Database\Seeder;

class categoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        categorys::insert([
            'category_name' => 'دوربین',
            'category_description' => 'دوربین',
            'category_status' => 1,
        ]);

    }
}
