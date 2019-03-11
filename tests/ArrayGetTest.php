<?php
declare(strict_types=1);

use Helper\TestBase;

final class ArrayGetTest extends TestBase
{
    public function tesGetValue()
    {
        $array = [
            'user' => [
                'name' => 'mike',
            ],
        ];
        $this->assertSame('mike', array_get($array, ['user', 'name']));
        $this->assertSame('mike', array_get($array, ['user.name']));
        $this->assertSame('mike', array_get($array, ['user_name'], '_'));
    }

    public function testGetValueWithNumber()
    {
        $array = [
            'names' => ['Mike', 'Jane'],
        ];
        $this->assertSame('Mike', array_get($array, ['names', 0]));
        $this->assertSame('Mike', array_get($array, 'names.0'));
        $this->assertSame('Jane', array_get($array, 'names_1', '_'));
    }

    public function testReturnsNullWhenGivenNotExistedKey()
    {
        $array = ['name' => 'mike'];
        $this->assertNull(array_get($array, '0.1'));
        $this->assertNull(array_get($array, 'd1.d2'));
        $this->assertNull(array_get($array, 'name.miss'));
    }

    public function testThrowsWhenInvalidTypePath()
    {
        $this->expectException(InvalidArgumentException::class);
        array_get([], true);
    }
}
