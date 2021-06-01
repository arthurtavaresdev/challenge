<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use Faker\Generator as Faker;

$factory->define(\App\CompanyAccount::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));

    $company = $faker->company;

    return [
        'social_name' => $company,
        'corporate_name' => $company . ' ' . $faker->companySuffix,
        'cnpj' => $faker->cnpj,
        'user_id' => factory(\App\User::class)
    ];
})->afterCreating(\App\CompanyAccount::class, function($model, $faker){
    $account = factory(Account::class)->create();
    $model->account()->save($account);
});
