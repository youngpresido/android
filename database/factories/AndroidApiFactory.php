<?php

use Faker\Generator as Faker;

$factory->define(App\Androidapi::class, function (Faker $faker) {
    return [
        'licence'=>$faker->unique->uuid,
        'phone'=>$faker->unique()->phoneNumber
    ];
});
