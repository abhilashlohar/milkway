<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'enrollment' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = true),
        'name' => $faker->name,
        'father_name' => $faker->name,
        'mother_name' => $faker->name,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'course_id' => '0b5f839b-b481-4be0-83c0-b72799d3efc1',
        'stream_id' => null,

    ];
});
