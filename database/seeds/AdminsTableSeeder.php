<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
        	'name' => 'Ahmed Elesnawy',
        	'email' => 'ahmed@gmail.com',
            'position' => 'Back-end Developer',
        	'password' => 'a5060180'
        ]);
    }
}
