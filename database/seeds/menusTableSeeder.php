<?php

use App\Menu;
use Illuminate\Database\Seeder;

class menusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        menu::insert([
            'name' => 'home',
            'url' => 'goggel',
        ]);
        menu::insert([
            'name' => 'log out',
            'url' => 'ulk',
        ]);
        menu::insert([
            'name' => 'Delaware',
            'url' => 'ds',
        ]);
        menu::insert([
            'name' => 'Delaware',
            'url' => 'ds',
        ]);
        menu::insert([
            'name' => 'login',
            'url' => 'login',
        ]);

    }
}
