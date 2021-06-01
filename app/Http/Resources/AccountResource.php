<?php

namespace App\Http\Resources;

use App\Enums\AccountType;
use App\PersonalAccount;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'agency' => $this->agency,
            'number' => $this->number,
            'digit' => $this->digit,
            'type' => $this->role_type == PersonalAccount::class ? AccountType::Personal() : AccountType::Company(),
            'account' => $this->account,
            'user' => $this->account->user ?? [],
            'transactions' => [
                'received' => $this->received_transactions,
                'sender' => $this->sender_transactions
            ]
        ];
    }
}
