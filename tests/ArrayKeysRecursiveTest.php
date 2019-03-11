<?php
declare(strict_types=1);

use Helper\TestBase;

final class ArrayKeysRecursiveTest extends TestBase
{
    public function testShallowArray()
    {
        $array = ['a', 'b', 'name' => 'mike', 'c'];
        $expected = [0, 1, 'name', 2];
        $this->assertSame($expected, array_keys_recursive($array));

        $this->assertEmpty(array_keys_recursive([]));
    }

    public function testDeepEmptyArray()
    {
        $array = [[]];
        $this->assertSame([0], array_keys_recursive($array));

        $array = [
            'name' => [],
        ];
        $this->assertSame(['name'], array_keys_recursive($array));
    }

    public function testDeepArray()
    {
        $array = [
            'Japan' => [
                'Tokyo' => [
                    'user1' => 'Mike',
                    'user2' => 'Jane',
                    'Hiro',
                    'Hanako',
                ],
                'Kyoto' => [],
            ],
            'Take',
        ];
        $expected = [
            ['Japan', 'Tokyo', 'user1'],
            ['Japan', 'Tokyo', 'user2'],
            ['Japan', 'Tokyo', 0],
            ['Japan', 'Tokyo', 1],
            ['Japan', 'Kyoto'],
            0,
        ];
        $this->assertSame($expected, array_keys_recursive($array));
    }
}
