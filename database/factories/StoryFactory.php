<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Story;
use Faker\Generator as Faker;

$factory->define(Story::class, function (Faker $faker) {
    return [
        'id' => $this->faker->randomNumber(),
        'content' => $this->faker->text,
        'status' => 'public',
        'users_id' => $this->faker->randomNumber(),
        'categories_id' => $this->faker->randomNumber(),
    ];
});
