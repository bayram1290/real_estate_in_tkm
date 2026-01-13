<?php

use Faker\Generator as Faker;

$factory->define(\App\Profile::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
	    'last_name' => $faker->lastName,
	    'about' => $faker->paragraph(5),
	    'add_phone' => $faker->phoneNumber,
    ];
});
