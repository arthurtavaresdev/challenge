<?php


namespace App\Http\Requests\Users;


use App\Account;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'string|max:255',
            'email' => 'email|string|max:255|unique:users',
            'telephone' => 'max:255',
            'cpf' => 'cpf|unique:users',
            'password' => 'string|confirmed',
            'account_id' => 'exists:'. Account::class .',id'
        ];
    }
}
