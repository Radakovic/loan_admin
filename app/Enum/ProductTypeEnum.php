<?php

namespace App\Enum;

use App\Models\Product;

/**
 * Values that {@see Product} type can have.
 */
enum ProductTypeEnum: string
{
    case CASH_LOAN = 'CASH_LOAN';
    case HOME_LOAN = 'HOME_LOAN';
}
