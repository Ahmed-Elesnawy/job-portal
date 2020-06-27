<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
	$exp = ['professional','fresh','mid-level'];
    return [
        'title' => $faker->name,
  
        'description' => $faker->text(),
        'exp_level' => $exp[rand(0,2)],
        'salary' => '5000/month',
        'apply_url' => $faker->url(),
        'type_id' => function(){
        	return \App\Models\Type::all()->random();
        },
        'country_id' => function(){
        	return \App\Models\Country::all()->random();
        },
        'category_id' => function(){
        	return \App\Models\Category::all()->random();
        },
        'user_id' => function(){
        	return \App\Models\User::whereLevel('company')->get()->random();
        },
    ];
});
