<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reward::class, function (Faker $faker) {
    return [

        'id_challengger'=>5,
        'nama'  => $faker->colorName,
        'foto'  => NULL,
        'point' => $faker->randomElement([2000,1000,5000]),
        'stock' => $faker->randomElement([2,3,5]),

    ];
});
