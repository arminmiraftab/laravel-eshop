<?php

use App\role_user;
use Illuminate\Database\Seeder;

class Rule_UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        role_user::insert([
            'user_id' =>1,
            'role_id' =>1,

        ]);
    }
}
