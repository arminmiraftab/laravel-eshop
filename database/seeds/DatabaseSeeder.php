<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            usersTableSeeder::class,
            customerTableSeeder::class,
            colorTableSeeder::class,
            categoryTableSeeder::class,
            commentsTableSeeder::class,
            iconsTableSeeder::class,
            manufactureTableSeeder::class,
            menusTableSeeder::class,
            order_detailsTableSeeder::class,
            order_detailsTableSeeder::class,
            Rule_UserTableSeeder::class,
            RuleTableSeeder::class,
            orderTableSeeder::class,
            paymentTableSeeder::class,
            productTableSeeder::class,
            shippingTableSeeder::class,
            sliderTableSeeder::class,
            sub_menusTableSeeder::class,
            ImageSeeder::class,

//            PostsTableSeeder::class,
//            CommentsTableSeeder::class,
        ]);
    }
}
