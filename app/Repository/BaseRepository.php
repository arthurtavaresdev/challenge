<?php


namespace App\Repository;


use App\Contracts\RepositoryInterface;
use App\User;
use Illuminate\Support\Collection;

class UserRepository implements RepositoryInterface
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): User
    {
        return $this->model->create($attributes);
    }

    public function find($id): ?User
    {
        return $this->model->find($id);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

}
