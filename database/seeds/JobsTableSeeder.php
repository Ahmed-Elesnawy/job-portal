<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Job::class,100)->create()->each(function($job){
            $job->skills()->sync([1,2,3]);
            $job->tags()->sync([1,2,3]);
         });
    }
}
