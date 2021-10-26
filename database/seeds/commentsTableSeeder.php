<?php

use App\commentsmol;
use Illuminate\Database\Seeder;

class commentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        commentsmol::insert([
            'title' => 'salam',
            'content' => 'this is content',
            'customer_id' => 1,
            'Product_id' => 1,

        ]);
        commentsmol::insert([
            'title' => 'salam',
            'content' => 'this is content',
            'customer_id' => 1,
            'Product_id' => 2,

        ]);
        commentsmol::insert([
            'title' => 'salam',
            'content' => 'this is content',
            'customer_id' => 1,
            'Product_id' => 3,

        ]);
        commentsmol::insert([
            'title' => 'salam',
            'content' => 'this is content',
            'customer_id' =>1,
            'Product_id' => 4,

        ]);
        commentsmol::insert([
            'title' => 'salam',
            'content' => 'this is content',
            'customer_id' => 1,
            'Product_id' => 1,

        ]);
    }
}
