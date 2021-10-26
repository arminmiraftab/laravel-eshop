<?php

use App\orders;
use Illuminate\Database\Seeder;

class orderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        orders::insert([
            'customer_id' => 1,
            'shipping_id' => 1,
            'order_total' => '7800',
            'payment_id' => 1,
            'created_at' => '2020-02-03 19:53:01',
            'order_status' => ' پرداخت شد',
        ]);

    }
}
