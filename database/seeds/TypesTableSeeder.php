<?php

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$types = ['FullTime','PartTime','Internship'];

    	foreach ( $types as $name )
    	{
    		Type::create([
    			'name' => $name,
    			'slug' => str_slug($name)
    		]);
    	}
    }
}
