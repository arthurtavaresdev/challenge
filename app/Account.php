<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Account extends Model
{
    use Notifiable, SoftDeletes;

    public function account(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'role_type', 'role_id');
    }

    public function received_transactions()
    {
        return $this->hasMany(Transaction::class, 'receiver_account_id');
    }

    public function sender_transactions()
    {
        return $this->hasMany(Transaction::class, 'sender_account_id');
    }
}
