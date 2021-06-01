<?php

namespace App\Http\Resources;

use App\Enums\AccountType;
use App\PersonalAccount;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountSimpleResource extends JsonResource
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
            'account' => $this->account,
            'user' => $this->account->user
        ];
    }
}
