<?php


namespace App\Http\Requests\Transaction;


use App\Account;
use App\Enums\TransactionType;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'value' => 'required|numeric',
            'type' => 'required|enum_key:' . TransactionType::class . ',false',
            'receiver_account_id' => 'required|exists:'. Account::class .',id',
            'sender_account_id' => 'required|exists:'. Account::class .',id'
        ];
    }
}
