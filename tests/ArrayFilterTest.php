<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;

final class ArrayFilterTest extends TestBase
{
    public function testMaintainKey()
    {
        $array = ['a1', 'b1', 'a2'];
        $filtered = array_filter($array, function ($v) {
            return preg_match('/^b/', $v);
        });
        $this->assertSame([1 => 'b1'], $filtered);
    }
}
