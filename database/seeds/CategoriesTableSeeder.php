<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $categories = ['Web','Android','Desktop','ML','Datasience'];

    	foreach ( $categories as $name )
    	{
    		Category::create([
    			'name' => $name,
    			'slug' => str_slug($name)
    		]);
    	}
    }
}
