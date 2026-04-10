<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Slider::create([
        //         'vi' => [ 'title' => 'slider', 'description' => 'slider home'],
        //         'jp' => [ 'title' => 'slider', 'description' => 'slider home'],
        //         'group' => 'parent', 'active' => 1
        //     ]);
        // Slider::create([
        //         'vi' => [ 'title' => 'team', 'description' => 'slider team'],
        //         'jp' => [ 'title' => 'team', 'description' => 'slider team'],
        //         'group' => 'parent', 'active' => 1
        // ]);
        // Slider::create([
        //         'vi' => [ 'title' => 'video', 'description' => 'slider video'],
        //         'jp' => [ 'title' => 'video', 'description' => 'slider video'],
        //         'group' => 'parent', 'active' => 1
        // ]);
        // Slider::create([
        //         'vi' => [ 'title' => 'partner', 'description' => 'slider partner'],
        //         'jp' => [ 'title' => 'partner', 'description' => 'slider partner'],
        //         'group' => 'parent', 'active' => 1
        // ]);
        // Slider::create([
        //         'vi' => [ 'title' => 'review', 'description' => 'slider review'],
        //         'jp' => [ 'title' => 'review', 'description' => 'slider review'],
        //         'group' => 'parent', 'active' => 1
        // ]);
        // Slider::create([
        //         'vi' => [ 'title' => 'introduce', 'description' => 'slider introduce'],
        //         'jp' => [ 'title' => 'introduce', 'description' => 'slider introduce'],
        //         'group' => 'parent', 'active' => 1
        // ]);
        // Slider::create([
        //         'vi' => [ 'title' => 'video_featured', 'description' => 'slider video_featured'],
        //         'jp' => [ 'title' => 'video_featured', 'description' => 'slider video_featured'],
        //         'group' => 'parent', 'active' => 1
        // ]);
        Slider::create([
            'vi' => [ 'title' => 'album', 'description' => 'slider album'],
            'jp' => [ 'title' => 'album', 'description' => 'slider album'],
            'group' => 'parent', 'active' => 1
    ]);
    }
}
