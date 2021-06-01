<?php


namespace App\Repository;


use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Exception;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @throws Exception
     */
    public function delete(?Model $model): bool
    {
        if($model && $model->exists){
            return $model->delete() ?? false;
        }

        return false;
    }

    public function update(Model $model, array $attributes): ?Model
    {
       if($model){
           $new = $model->fill($attributes);
           $success = $model->save();

           if(!$success){
               return null;
           }

           return $new;
       }

       return null;
    }
}
