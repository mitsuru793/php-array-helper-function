<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;

final class IsEmptyArrayTest extends TestBase
{
    public function testReturnsTrueWhenEmpty()
    {
        $this->assertTrue(is_empty_array([]));
    }

    public function testReturnsFalseWhenGivenScala()
    {
        $inputs = [0, 1, true, false, '', 'a', null];
        foreach ($inputs as $input) {
            $this->assertFalse(is_empty_array($input));
            $this->assertFalse(is_empty_array([$input]));
        }
    }

    public function testReturnsFalseWhenGiveDeep()
    {
        $inputs = [
            [null, null],
            [1, [2]],
            [1, []],
            [[], []],
        ];
        foreach ($inputs as $input) {
            $this->assertFalse(is_empty_array($input));
        }
    }
}