<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Modules\Cliente\Models\Cliente;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'tipo_pessoa' => 'PF',
        'cpf' => $faker->regexify('[0-9]{3}[.][0-9]{3}[.][0-9]{3}[-][0-9]{2}')
    ];
});
