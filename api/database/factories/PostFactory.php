<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Posts\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 2),
        'subject_id' => rand(1, 3),
        'title' => $faker->sentence(),
        'slug' => \Str::slug($faker->sentence()) . \Str::random(6),
        'body' => $faker->paragraph(15)
    ];
});
