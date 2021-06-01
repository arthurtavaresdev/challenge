<?php


namespace App\Http\Requests\Account;


use App\Account;
use App\Enums\AccountType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'agency' => 'integer|size:4',
            'digit' => 'integer|size:1',
            'number' => 'string',
            'social_name' => 'string',
            'corporate_name' => 'string',
            'cnpj' => 'cnpj',
            'account_type' => 'enum_key:' . AccountType::class . ',false'
        ];
    }
}
