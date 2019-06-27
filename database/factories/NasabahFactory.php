<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Nasabah::class, function (Faker $faker) {
    return [

        // 'id_user',
        'ktp'       => $faker->creditCardNumber,
        'alamat'    => $faker->address,
        'saldo'     => $faker->randomElement([2000,1000,3000]),
        'dusun'     => $faker->randomElement(['sukamaju','sukabangkit','sukabera']),

    ];
});
