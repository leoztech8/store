<?php

use Faker\Generator as Faker;
use Modules\Store\Entities\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
