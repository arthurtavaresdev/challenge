<?php

namespace App\Http\Controllers;

use App\Contracts\UserRepositoryInterface;
use App\Exceptions\HttpException;
use App\Http\Requests\Users\QueryUserRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{

    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @param QueryUserRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(QueryUserRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $name = $request->input('q');
        if($name){
            return UserResource::collection($this->repository->search($name));
        }

        $users = $this->repository->all();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $user = $this->repository->create($request->all());
        return new UserResource($user);
    }


    /**
     * Display the specified resource.
     *
     * @param $id
     * @return UserResource
     */
    public function show($id): UserResource
    {
        $user = $this->repository->find($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param $id
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, $id): UserResource
    {
        $user = $this->repository->find($id);
        if($user){
            $model = $this->repository->update($user, $request->all());
            if($model){
                return new UserResource($model);
            }
        }


        throw new HttpException(400, 'Não foi possível atualizar o Usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id): JsonResponse
    {
        $model = $this->repository->find($id);
        if($this->repository->delete($model)){
            return response()->json(['message' => 'OK'], 201);
        }

        throw new HttpException(400, "Não foi possível deletar o usuario");
    }
}

