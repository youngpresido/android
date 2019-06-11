<?php

$factory->define(App\Lecturer::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "school" => $faker->name,
        "account_number" => $faker->randomNumber(2),
        "email" => $faker->safeEmail,
        "bank" => $faker->name,
        "department" => $faker->name,
        "referer_code" => $faker->name,
    ];
});
