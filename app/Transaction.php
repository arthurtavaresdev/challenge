<?php

namespace App;

use App\Enums\TransactionType;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use Notifiable, SoftDeletes, CastsEnums;

    protected $fillable = ['value', 'type', 'receiver_account_id', 'sender_account_id'];

    protected $casts = [
        'type' => TransactionType::class
    ];

    public function sender_account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function receiver_account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
