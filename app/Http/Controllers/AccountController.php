<?php

namespace App\Http\Controllers;

use App\Account;
use App\Contracts\AccountRepositoryInterface;
use App\Exceptions\HttpException;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Http\Resources\AccountResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountController extends Controller
{
    private AccountRepositoryInterface $repository;

    public function __construct(AccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return AccountResource::collection($this->repository->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccountRequest $request
     * @return AccountResource
     */
    public function store(StoreAccountRequest $request): AccountResource
    {
        $account = $this->repository->create($request->all());
        return new AccountResource($account);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \App\Http\Resources\AccountResource
     */
    public function show($id): AccountResource
    {
        $user = $this->repository->find($id);
        return new AccountResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAccountRequest $request
     * @param $id
     * @return AccountResource
     */
    public function update(UpdateAccountRequest $request, $id): AccountResource
    {
        $model = $this->repository->find($id);
        $account = $this->repository->update($model, $request->all());
        return new AccountResource($account);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $model = $this->repository->find($id);
        if($this->repository->delete($model)){
            return response()->json(['message' => 'OK'], 201);
        }

        throw new HttpException(400, "Não foi possível deletar o usuario");
    }
}
