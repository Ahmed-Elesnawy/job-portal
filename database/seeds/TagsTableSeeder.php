<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $tags = ['PHP','JS','Laravel','VueJs','Django','Python','Help','Develper'];

    	foreach ( $tags as $name )
    	{
    		Tag::create([
    			'name' => $name,
    			'slug' => str_slug($name)
    		]);
    	}
    }
}
