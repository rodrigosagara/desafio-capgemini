<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Modules\Conta\Models\Conta;

$factory->define(Conta::class, function (Faker $faker) {
    return [
        'num_conta' => $faker->numberBetween(10000,100000),
        'saldo' => $faker->numberBetween(0,5),
        'cliente_id' => \factory(\App\Modules\Cliente\Models\Cliente::class)
    ];
});
