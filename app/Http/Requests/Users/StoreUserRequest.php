<?php

namespace App\Http\Requests\Users;

use App\Account;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'telephone' => 'required|max:255',
            'cpf' => 'required|cpf|unique:users',
            'password' => 'required|string|confirmed',
            'account_id' => 'exists:'. Account::class .',id'
        ];
    }
}
