<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;
use stdClass;

abstract class ArrayDiffKeyTestBase extends TestBase
{
    public function testIgnoreScalaValue()
    {
        $values = [null, 0, 1, '', 'hi', true, false, new stdClass()];

        foreach ($values as $main) {
            foreach ($values as $other) {
                $this->assertNoDiff([$main], [$other]);
                $this->assertNoDiff(['k' => $main], ['k' => $other]);
            }
        }
    }

    public function testNumberIndexDeep()
    {
        $this->assertNoDiff([0 => true], [false]);
        $this->assertNoDiff(['Mike', 'man'], ['Jane', 'woman']);

        $diff = array_diff_key(['Mike', 'man'], ['Jane']);
        $this->assertSame([1 => 'man'], $diff);

        $this->assertNoDiff(['Jane'], ['Mike', 'man']);
    }

    abstract public function testStringIndexDeep1();

    abstract public function testStringIndexDeep2();

    abstract protected function assertNoDiff($main, $other): void;
}
