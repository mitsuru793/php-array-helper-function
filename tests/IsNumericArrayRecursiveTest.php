<?php
declare(strict_types=1);

namespace Php;

final class IsNumericArrayRecursiveTest extends IsNumericArrayTestBase
{
    public function testDeep()
    {
        $this->assertNumeric([
            [],
        ]);

        $this->assertNotNumeric([
            ['name' => 'mike'],
            ['name' => 'jane'],
        ]);

        $this->assertNumeric([
            [1, 2],
            3,
            [[4]],
        ]);

        $this->assertNotNumeric([
            [1, 2],
            3,
            [['k' => 4]],
        ]);
    }

    protected function assertNumeric($array): void
    {
        $this->assertTrue(is_numeric_array_recursive($array));
    }

    protected function assertNotNumeric($array): void
    {
        $this->assertFalse(is_numeric_array_recursive($array));
    }
}