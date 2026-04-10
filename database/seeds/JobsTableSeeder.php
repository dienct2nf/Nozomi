<?php

use Illuminate\Database\Seeder;
use App\Models\Job;
class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Job::class, 5)->create();
    }
}
