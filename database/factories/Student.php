<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'nim'  => Str::random(10),
        'name' => $faker->name,
        'faculty_id' => 5,
        'major_id'   => 17,
        'born' => 'Bireun',
        'birth' => '2020-06-04',
        'email' =>  $faker->safeEmail, // $faker->unique()->safeEmail,
        'password' => bcrypt('password'), // password
        'remember_token' => Str::random(10),
    ];
});
