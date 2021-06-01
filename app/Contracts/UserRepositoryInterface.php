<?php


namespace App\Contracts;


use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function search($value): Collection;
}
