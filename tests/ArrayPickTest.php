<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;

final class ArrayPickTest extends TestBase
{
    public function testMaintainKey()
    {
        $array = ['a', null, 'b'];
        $picked = array_pick($array, [null]);
        $this->assertSame([1 => null], $picked);
        $this->assertSame([0 => 'a', 2 => 'b'], $array);

        $array = ['a', 'key' => null, 'b'];
        $picked = array_pick($array, [null]);
        $this->assertSame(['key' => null], $picked);
        $this->assertSame([0 => 'a', 1 => 'b'], $array);
    }

    public function testMatchSameValues()
    {
        $array = ['a', null, null, 'b'];
        $picked = array_pick($array, [null]);
        $this->assertSame([1 => null, 2 => null], $picked);
        $this->assertSame([0 => 'a', 3 => 'b'], $array);

        $array = ['a', 'k1' => null, 'k2' => null, 'b'];
        $picked = array_pick($array, [null]);
        $this->assertSame(['k1' => null, 'k2' => null], $picked);
        $this->assertSame([0 => 'a', 1 => 'b'], $array);
    }

    public function testGivenValues()
    {
        $array = ['a', null, true, 'b'];
        $picked = array_pick($array, ['a', true]);
        $this->assertSame([0 => 'a', 2 => true], $picked);
        $this->assertSame([1 => null, 3 => 'b'], $array);

        $array = ['a', 'k1' => null, 'k2' => true, 'b'];
        $picked = array_pick($array, [null, true]);
        $this->assertSame(['k1' => null, 'k2' => true], $picked);
        $this->assertSame([0 => 'a', 1 => 'b'], $array);
    }

    public function testMatchStrict()
    {
        $array = ['a', '', null, 0, false];

        $picked = array_pick($array, [false]);
        $this->assertSame([4 => false], $picked);
        $this->assertSame(['a', '', null, 0], $array);
    }
}
