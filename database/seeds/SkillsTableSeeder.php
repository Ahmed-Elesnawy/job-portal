<?php

use Illuminate\Database\Seeder;
use App\Models\Skill;
class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = ['PHP','JS','Laravel','VueJs','Django','Python'];

    	foreach ( $skills as $name )
    	{
    		Skill::create([
    			'name' => $name,
    			'slug' => str_slug($name)
    		]);
    	}
    }
}
