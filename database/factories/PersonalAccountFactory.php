<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use Faker\Generator as Faker;

$factory->define(\App\PersonalAccount::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)
    ];
});
