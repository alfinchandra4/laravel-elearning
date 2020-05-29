<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lecturer;
use Faker\Generator as Faker;

$factory->define(Lecturer::class, function (Faker $faker) {
    return [
        'nidn' => '10293',
        'name' => $faker->name,
        'email' => 'dosen@user.com',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});
