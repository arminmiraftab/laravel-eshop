<?php

use App\shippings;
use Illuminate\Database\Seeder;

class shippingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        shippings::insert([
            'customer_id' =>1,
            'shipping_code_post' =>55525258 ,
            'shipping_adderss_map' =>'تهران , کاووسیه , خلیل زاده' ,
            'shipping_address' =>'تهران , کاووسیه , گاندی شمالی' ,
            'House_number' =>21 ,
            'long' =>51.42331338 ,
            'lat' =>35.76024823 ,
            'shipping_unit' =>5 ,
        ]);
    }
}
