<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
        	'name_en' => 'Jop Portal',
        	'name_ar' => 'عالم الوظائف',
        	'desc'    => 'lorem ipsum dolor mon ami.',
        ]);
    }
}
