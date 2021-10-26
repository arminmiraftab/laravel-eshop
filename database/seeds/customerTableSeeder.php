<?php

use App\customermol;
use Illuminate\Database\Seeder;

class customerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        customermol::insert([
            'customer_name' => 'usc',
            'customer_email' => 'usc@usc',
            'password' => md5('usc@usc'),
            'mobil_number' => '09124567893',
            'code_mli' => '0021918422',
            'customer_image' => 'image/AxqOjaJ4TBTxvTSsjZH9.jpg',
            'last_name' => 'usc',

        ]);

    }
}
