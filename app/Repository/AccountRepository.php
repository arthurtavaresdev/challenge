<?php


namespace App\Repository;


use App\Account;
use App\CompanyAccount;
use App\Contracts\AccountRepositoryInterface;
use App\Enums\AccountType;
use App\PersonalAccount;
use Illuminate\Database\Eloquent\Model;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{

    /**
     * @var Account
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $this->model->agency = $attributes['agency'];
        $this->model->number = $attributes['number'];
        $this->model->digit = $attributes['digit'];
        $this->model->save();

        if(AccountType::Company()->key == $attributes['type']){
            $account = new CompanyAccount();
            $account->cnpj = $attributes['cnpj'];
            $account->social_name = $attributes['social_name'];
            $account->corporate_name = $attributes['corporate_name'];
            $account->save();
        } else {
            $account = new PersonalAccount();
            $account->save();
        }

        $account->account()->save($this->model);
        return $this->model;
    }

    public function update(Model $model, array $attributes): ?Model
    {

        if($model){
            $model->agency = $attributes['agency'] ?? $model->agency;
            $model->number = $attributes['number'] ?? $model->number;
            $model->digit = $attributes['digit'] ?? $model->digit;
            $success = $model->save();

            if(!$success){
                return null;
            }

            $newAccount = $model->account();
            $newAccount->social_name = $attributes['social_name'] ?? $model->social_name;
            $newAccount->corporate_name = $attributes['corporate_name'] ?? $model->corporate_name;
            $newAccount->cnpj = $attributes['cnpj'] ?? $model->cnpj;
            $success = $newAccount->save();

            if(!$success){
                return null;
            }

            return $model;
        }

        return null;
    }

}
