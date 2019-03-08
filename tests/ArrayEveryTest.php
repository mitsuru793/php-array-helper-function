<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;

final class ArrayEveryTest extends TestBase
{
    public function testReturnsTrueWhenGivenEmpty()
    {
        $this->assertEvery([]);
        $this->assertEvery([], function () {
            return false;
        });
    }

    public function testWithoutFunc()
    {
        $this->assertNotEvery([null]);
        $this->assertNotEvery([null, 0, '']);
        $this->assertNotEvery([0, '']);
        $this->assertNotEvery([0, '', 'a']);

        $this->assertEvery([1]);
        $this->assertEvery([1, 'a']);
    }

    public function testWithFunc()
    {
        $nums = [2, 4, 6];
        $this->assertEvery($nums, function ($v) {
            return $v % 2 === 0;
        });

        $nums = [2, 4, 7];
        $this->assertNotEvery($nums, function ($v) {
            return $v % 2 === 0;
        });

        $nums = ['name1' => 'mike', 'name2' => 'jane', 'name3' => 'smith'];
        $this->assertEvery($nums, function ($v, $k) {
            return preg_match('/^name/', $k);
        });

        $nums = ['name1' => 'mike', 'name2' => 'jane', 'item1' => 'banana'];
        $this->assertNotEvery($nums, function ($v, $k) {
            return preg_match('/^name/', $k);
        });
    }

    private function assertEvery(array $array, callable $callable = null): void
    {
        $this->assertTrue(array_every($array, $callable));
    }

    private function assertNotEvery(array $array, callable $callable = null): void
    {
        $this->assertFalse(array_every($array, $callable));
    }
}