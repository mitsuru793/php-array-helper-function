<?php
declare(strict_types=1);

namespace Php;

final class IsNumericArrayTest extends IsNumericArrayTestBase
{
    public function testDeep()
    {
        $this->assertNumeric([
            [],
        ]);

        $this->assertNumeric([
            ['name' => 'mike'],
            ['name' => 'jane'],
        ]);

        $this->assertNumeric([
            [1, 2],
            3,
            [[4]],
        ]);

        $this->assertNumeric([
            [1, 2],
            3,
            [['k' => 4]],
        ]);
    }

    protected function assertNumeric($array): void
    {
        $this->assertTrue(is_numeric_array($array));
    }

    protected function assertNotNumeric($array): void
    {
        $this->assertFalse(is_numeric_array($array));
    }
}
