<?php
declare(strict_types=1);

use Faker\Generator as Faker;
use App\Models\Todo;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
