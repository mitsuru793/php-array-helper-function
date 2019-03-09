<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;

abstract class IsNumericArrayTestBase extends TestBase
{
    public function testReturnsFalseWhenGivenScala()
    {
        $inputs = [0, 1, true, false, '', 'a', null];
        foreach ($inputs as $input) {
            $this->assertNotNumeric($input);

        }
    }

    public function testShallow()
    {
        $this->assertNumeric(['mike', 19]);
        $this->assertNumeric([1 => true, 5 => true]);

        $this->assertNotNumeric(['name' => 'mike']);
        $this->assertNotNumeric([true, 'name' => 'mike']);
        $this->assertNotNumeric([5 => true, 'name' => 'mike']);
        $this->assertNotNumeric(['name' => 'mike', true]);
        $this->assertNotNumeric(['name' => 'mike', 5 => true]);
    }

    abstract public function testDeep();

    abstract protected function assertNumeric($array): void;

    abstract protected function assertNotNumeric($array): void;
}
