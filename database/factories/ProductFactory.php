<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    $Price = $faker->randomFloat(2, 1, 1000);
    $discountType = $faker->randomElement(['None', 'Fixed', 'Percentage']);
    $discount = 0;
    if ($discountType === 'Fixed') {
        $discount = $faker->randomFloat(2, 1, $Price);
    } elseif ($discountType === 'Percentage') {
        $discount = $faker->randomFloat(2, 1, 100);
    }
    return [
        'name' => $faker->name,
        'price' => $Price,
        'discount_type' => $discountType,
        'discount' => $discount
    ];
});
