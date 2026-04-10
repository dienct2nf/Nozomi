<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'name' => 'menu_header',
            'description' => 'Menu header'
        ]);

        Menu::create([
            'name' => 'menu_footer',
            'description' => 'Menu footer'
        ]);

        Menu::create([
            'name' => 'infomation',
            'description' => 'Infomation website'
        ]);
        Menu::create([
            'name' => 'overview',
            'description' => 'Overview website'
        ]);
    }
}
