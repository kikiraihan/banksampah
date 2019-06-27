<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Sampah::class, function (Faker $faker) {
    return [
        // 'nama' => $faker->colorName,
        // 'deskripsi' => $faker->paragraph,
        'nama' => $faker->randomElement([
            'Pembungkus Plastik',
            'Botol kaca',
        ]),
        'deskripsi' => $faker->randomElement([
            'Pembungkus makanan ringan, plastik kemasan, dll',
            'Botol sosro, fanta, cocacola, cocol aku bang, dan botol minuman lain.',
        ]),
        'satuan' => $faker->randomElement(['kg','gram','pcs']),
        'point' => $faker->randomElement([200,100,300]),
    ];
});
