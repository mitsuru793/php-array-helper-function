<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;

final class IsFullArrayTest extends TestBase
{
    public function testReturnsFalseWhenEmpty()
    {
        $inputs = [[], 0, 1, true, false, '', 'a', null];
        foreach ($inputs as $input) {
            $this->assertFalse(is_full_array($input));
        }
    }

    public function testReturnsTrueWhenGivenScala()
    {
        $inputs = [0, 1, true, false, '', 'a', null];
        foreach ($inputs as $input) {
            $this->assertTrue(is_full_array([$input]));
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
            $this->assertTrue(is_full_array($input));
        }
    }
}