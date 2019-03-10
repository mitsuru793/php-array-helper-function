<?php
declare(strict_types=1);

namespace Php;

use Helper\TestBase;

final class ArrayFilterRecursiveTest extends TestBase
{
    public function testNoFunc()
    {
        $array = [
            'v1',
            '',
            'd2' => [
                'v2',
                null,
                'd3' => [
                    'v3',
                    false,
                    0,
                ],
            ],
        ];
        $expected = [
            'v1',
            'd2' => [
                'v2',
                'd3' => [
                    'v3',
                ],
            ],
        ];

        $filtered = array_filter_recursive($array);
        $this->assertSame($expected, $filtered);
    }

    public function testRemoveRecursiveEmptyArray()
    {
        $array = [
            'v1',
            'd2' => [
                'v2',
                'd3-1' => [
                    null,
                    'd4' => [
                        null,
                    ],
                ],
                'd3-2' => [
                    'v3',
                    null,
                ],
            ],
        ];
        $expected = [
            'v1',
            'd2' => [
                'v2',
                'd3-2' => [
                    'v3',
                ],
            ],
        ];

        $filtered = array_filter_recursive($array);
        $this->assertSame($expected, $filtered);
    }

    public function testFuncWithoutKey()
    {
        $array = [
            'Japan' => [
                'Hiroki-Man',
                'Kaede-Woman',
                'Tokyo' => [
                    'Taro-Man',
                    'Hanako-Woman',
                ],
            ],
            'America' => [
                'Jane-Woman',
                'Mike-Man',
            ],
        ];
        $expected = [
            'Japan' => [
                'Hiroki-Man',
                'Tokyo' => [
                    'Taro-Man',
                ],
            ],
            'America' => [
                1 => 'Mike-Man',
            ],
        ];

        $filtered = array_filter_recursive($array, function ($v) {
            if (!is_string($v)) {
                return true;
            }
            return preg_match('/Man/', $v);
        });
        $this->assertSame($expected, $filtered);
    }

    public function testFuncWithKey()
    {
        $array = [
            [
                'name' => 'Mike',
                'sex' => 'man',
            ],
            [
                'name' => 'Jane',
                'sex' => 'woman',
            ],
        ];
        $expected = [
            ['name' => 'Mike'],
            ['name' => 'Jane'],
        ];

        $filtered = array_filter_recursive($array, function ($v, $k) {
            if (!is_string($k)) {
                return true;
            }
            return !preg_match('/sex/', $k);
        });
        $this->assertSame($expected, $filtered);
    }
}
