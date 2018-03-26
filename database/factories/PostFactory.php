<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence(5);
    return [
        'title' => $title,
        'content' => $faker->paragraphs(4, true),
        'featured' => 'uploads/posts/' . $faker->image('public/uploads/posts',1110,430, 'transport', false),
        'category_id' => App\Category::all()->random()->id
    ];
});
