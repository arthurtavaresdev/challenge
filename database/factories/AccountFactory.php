<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\pt_BR\Payment($faker));

    $roles = [
        App\CompanyAccount::class,
        App\PersonalAccount::class,
    ];
    $roleType = $faker->randomElement($roles);
    $role = factory($roleType)->create();

    return [
        'role_id' => $role,
        'role_type' => $roleType,
        'agency' => $faker->randomNumber(4),
        'number' => $faker->bankAccountNumber,
        'digit' => $faker->randomDigit
    ];
});
