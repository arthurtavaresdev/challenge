<?php


namespace App\Repository;


use App\Contracts\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function search($value): Collection
    {
        return $this->model->newQuery()
            ->where(DB::raw('lower(name)'), 'LIKE', "%" . strtolower($value) . "%")
            ->orWhere(DB::raw('lower(cpf)'), 'LIKE', "%" . strtolower($value) . "%")
            ->get();
    }

}
