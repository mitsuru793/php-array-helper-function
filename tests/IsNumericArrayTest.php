<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;

final class IsNumericArrayTest extends TestBase
{
    public function testDeep1()
    {
        $this->assertNumeric(['mike', 19]);
        $this->assertNumeric([1 => true, 5 => true]);

        $this->assertNotNumeric(['name' => 'mike']);
        $this->assertNotNumeric([true, 'name' => 'mike']);
        $this->assertNotNumeric([5 => true, 'name' => 'mike']);
        $this->assertNotNumeric(['name' => 'mike', true]);
        $this->assertNotNumeric(['name' => 'mike', 5 => true]);
    }

    public function testDeep2()
    {
        $this->assertNumeric([
            [],
        ]);

        $this->assertNumeric([
            ['name' => 'mike'],
            ['name' => 'jane'],
        ]);
    }

    private function assertNumeric($array): void
    {
        $this->assertTrue(is_numeric_array($array));
    }

    private function assertNotNumeric($array): void
    {
        $this->assertFalse(is_numeric_array($array));
    }
}