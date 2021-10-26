<?php

use App\order_details;
use Illuminate\Database\Seeder;

class order_detailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        order_details::insert([
            'order_id' => 1,
            'Product_id' => 3,
            'Product_name' => 'گوشی سامسونگ',
            'Product_price' => 7800,
            'Product_sales_quantity' => 1,
            'customer_id' => 1,
            'shipping_id' => 1,
            'state_fa' => 1,
            'time_fa' => 1580760608,
        ]);
    }
}
