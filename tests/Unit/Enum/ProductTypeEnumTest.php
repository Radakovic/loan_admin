<?php

namespace Tests\Unit\Enum;

use App\Enum\ProductTypeEnum;
use PHPUnit\Framework\TestCase;

class ProductTypeEnumTest extends TestCase
{
    public function testProductEnumValues(): void
    {
        $cases = ProductTypeEnum::cases();

        foreach ($cases as $case) {
            self::assertNotNull(ProductTypeEnum::tryFrom($case->value));
            self::assertSame($case->value, ProductTypeEnum::tryFrom($case->value)->value);
        }
    }
}
