<?php

namespace App\Http\Controllers;

use App\Contracts\TransactionRepositoryInterface;
use App\Exceptions\HttpException;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TransactionRepositoryInterface $repository;

    public function __construct(TransactionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTransactionRequest $request
     * @return TransactionResource
     */
    public function store(StoreTransactionRequest $request): TransactionResource
    {
        $model = $this->repository->create($request->all());
        return new TransactionResource($model);
    }


}
