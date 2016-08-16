<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
    	'title' => $faker->sentence(5),
    	'body' => $faker->paragraph(4),
    	'published_at' => Carbon::now(),
    	'created_at' => Carbon::now(),
    	'updated_at' => Carbon::now(),
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
    	'name' => $faker->sentence(1),
    	'created_at' => Carbon::now(),
    	'updated_at' => Carbon::now(),
    ];
});
