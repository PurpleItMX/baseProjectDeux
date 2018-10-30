<?php

use Faker\Generator as Faker;

$factory->define(App\Menu::class, function (Faker $faker) {
    return [
        'id_parent' => null ,
    	'name' => 'Configuración', 
    	'url' => 'ruta',
    	'icono' => null,
    ];
});
