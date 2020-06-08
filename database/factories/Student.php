<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'nim'  => Str::random(10),
        'name' => $faker->name,
        'faculty_id' => 5,
        'major_id'   => 17,
        'born' => 'Bireun',
        'birth' => '2020-06-04',
        'email' =>  $faker->safeEmail, // $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
