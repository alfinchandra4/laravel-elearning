<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lecturer;
use Faker\Generator as Faker;

$factory->define(Lecturer::class, function (Faker $faker) {
    return [
        'nidn' => '10293',
        'name' => $faker->name,
        'email' => 'dosen@ulecturer.com',
        'password' => bcrypt('password'), // password
    ];
});
