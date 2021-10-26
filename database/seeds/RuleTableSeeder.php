<?php

use App\role;
use Illuminate\Database\Seeder;

class RuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        role::insert([
            'name' =>'user',

        ]);
        role::insert([
            'name' =>'admin',

        ]);

    }

}
