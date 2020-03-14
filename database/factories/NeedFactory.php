<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Need;
use Faker\Generator as Faker;

$factory->define(Need::class, function (Faker $faker) {
    $user = factory(App\User::class);
    return [
        'title' => $faker->sentence,
        'preview' => $faker->sentences(3, true),
        'description' => $faker->paragraph,
        'lat' => $user->lat,
        'lng' => $user->lng,
        'user_id' => $user
    ];
});
