<?php

use Faker\Generator as Faker;

$factory->define(App\MenuRole::class, function (Faker $faker) {
    return [
     	'id_role' => 1,
    	'id_menu' => 1,
    ];
});
