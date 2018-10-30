<?php

use Faker\Generator as Faker;

$factory->define(App\UserRole::class, function (Faker $faker) {
    return [
        'id_role' => 1,
    	'id_user' => 1,
    ];
});
