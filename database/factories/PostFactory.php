<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

	$title = $faker->name;
    return [
        'admin_id' => 1,
        'title' => $title,
        'body' => $faker->text(),
        'slug' => str_slug($title)
    ];
});
