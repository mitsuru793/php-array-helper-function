<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;

final class ArrayAnyTest extends TestBase
{
    public function testReturnsFalseWhenGivenEmpty()
    {
        $this->assertNotAny([]);
        $this->assertNotAny([], function () {
            return false;
        });
    }

    public function testWithoutFunc()
    {
        $this->assertNotAny([null]);
        $this->assertNotAny([null, 0, '']);
        $this->assertNotAny([0, '']);

        $this->assertAny([0, '', 'a']);
        $this->assertAny([1]);
        $this->assertAny([1, 'a']);
    }

    public function testWithFunc()
    {
        $nums = [2, 4, 6];
        $this->assertAny($nums, function ($v) {
            return $v % 2 === 0;
        });

        $nums = [2, 4, 7];
        $this->assertAny($nums, function ($v) {
            return $v % 2 === 0;
        });

        $nums = [1, 3, 5];
        $this->assertNotAny($nums, function ($v) {
            return $v % 2 === 0;
        });

        $nums = ['name1' => 'mike', 'name2' => 'jane', 'name3' => 'smith'];
        $this->assertAny($nums, function ($v, $k) {
            return preg_match('/^name/', $k);
        });

        $nums = ['name1' => 'mike', 'name2' => 'jane', 'item1' => 'banana'];
        $this->assertAny($nums, function ($v, $k) {
            return preg_match('/^name/', $k);
        });

        $nums = ['item1' => 'banana', 'item2' => 'orange', 'item3' => 'apple'];
        $this->assertNotAny($nums, function ($v, $k) {
            return preg_match('/^name/', $k);
        });
    }

    private function assertAny(array $array, callable $callable = null): void
    {
        $this->assertTrue(array_any($array, $callable));
    }

    private function assertNotAny(array $array, callable $callable = null): void
    {
        $this->assertFalse(array_any($array, $callable));
    }
}
