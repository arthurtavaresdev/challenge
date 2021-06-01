<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Transaction::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2),
        'type'  => \App\Enums\TransactionType::getRandomKey(),
        'receiver_account_id' => factory(\App\Account::class),
        'sender_account_id' => factory(\App\Account::class)
    ];
});
