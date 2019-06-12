<?php

$factory->define(App\Payment::class, function (Faker\Generator $faker) {
    return [
        "lecturer_id" => factory('App\Lecturer')->create(),
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "status" => $faker->randomNumber(2),
    ];
});
