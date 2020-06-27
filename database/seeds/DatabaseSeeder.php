<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
    	 $this->call(LaratrustSeeder::class);
         $this->call(AdminsTableSeeder::class);
         $this->call(SettingsTableSeeder::class);
         $this->call(TypesTableSeeder::class);
         $this->call(CountriesTableSeeder::class);
         $this->call(SkillsTableSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(PostsTableSeeder::class);
         $this->call(JobsTableSeeder::class);
    }
}
