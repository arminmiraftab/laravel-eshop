<?php

use App\admins;
use App\Http\Controllers\admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        admins::insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'is_super' => '1',
            'password' =>Hash::make( 'admin@admin.com'),
//                '$2y$10$PoPVnjTIg9uCBlUZTT2fRePb.QkjplZ6KkTL2Qmd1yWrla/XDW1AS',
        ]);
    }
}
