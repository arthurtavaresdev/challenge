<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Personal()
 * @method static static Company()
 */
final class AccountType extends Enum
{
    const Personal = 0;
    const Company = 1;
}
