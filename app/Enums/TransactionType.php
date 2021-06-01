<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
/**
 * @method static static Bill_Payment()
 * @method static static Deposit()
 * @method static static Transfer()
 * @method static static Telephone_Recharge()
 * @method static static Credit()
 */
final class TransactionType extends Enum
{
    const Bill_Payment = 0;
    const Deposit = 1;
    const Transfer = 2;
    const Telephone_Recharge = 3;
    const Credit = 4;
}
