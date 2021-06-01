<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CompanyAccount extends Model
{
    use Notifiable, SoftDeletes;

    public function account(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Account::class, 'role');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
