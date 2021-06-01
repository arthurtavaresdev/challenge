<?php

namespace App\Http\Requests\Account;

use App\Account;
use App\Enums\AccountType;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'agency' => 'required|integer',
            'digit' => 'required|integer',
            'number' => 'string',
            'type' => 'required|enum_key:' . AccountType::class . ',false',
            'social_name' => 'required_if:type,' . AccountType::Company()->key .'|string',
            'corporate_name' => 'required_if:type,' . AccountType::Company()->key .'|string',
            'cnpj' => 'required_if:type,' . AccountType::Company()->key .'|cnpj|unique:company_accounts'
        ];
    }
}
