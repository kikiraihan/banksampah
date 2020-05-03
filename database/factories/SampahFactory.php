<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Sampah::class, function (Faker $faker) {
    return [
        // 'nama' => $faker->colorName,
        // 'deskripsi' => $faker->paragraph,
        'id_pengepul' => 5,
        'nama' => $faker->randomElement([
            'Pembungkus Plastik',
            'Botol kaca',
        ]),
        'deskripsi' => $faker->randomElement([
            'Pembungkus makanan ringan, plastik kemasan, dll',
            'Botol sosro, fanta, cocacola, cocol aku bang, dan botol minuman lain.',
        ]),
        'per_angka' => $faker->randomElement(['1000','100','1']),
        'per_satuan' => $faker->randomElement(['kg','gram','pcs']),
        'harga' => $faker->randomElement([2000,1000,3000]),
    ];
});
