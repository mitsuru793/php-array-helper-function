<?php
declare(strict_types=1);

namespace Php;

final class ArrayDiffKeyRecursiveTest extends ArrayDiffKeyTestBase
{
    protected function assertNoDiff($main, $other): void
    {
        $invalidKeys = array_diff_key_recursive($main, $other);
        $this->assertEmpty($invalidKeys);
    }

    public function testStringIndexDeep1()
    {
        $main = [
            'name' => 'Mike',
            'age' => 20,
        ];
        $other = [
            'name' => 'Jane',
            'age' => 21,
        ];
        $this->assertNoDiff($main, $other);

        $main = [
            'name' => 'Mike',
            'age' => 20,
        ];
        $other = [
            'name' => 'Jane',
            'from' => 'America',
            'sex' => 'woman',
        ];
        $this->assertSame(['age' => 20], array_diff_key_recursive($main, $other));
        $this->assertSame(['from' => 'America', 'sex' => 'woman'], array_diff_key_recursive($other, $main));
    }

    public function testStringIndexDeep2()
    {
        $main = [
            'user' => [
                'name' => 'Mike',
                'age' => 20,
            ],
        ];
        $other = [
            'id' => 2,
            'user' => [
                'name' => 'Jane',
                'from' => 'America',
                'sex' => 'woman',
            ],
        ];
        $this->assertSame(['user' => ['age' => 20]], array_diff_key_recursive($main, $other));

        $expected = [
            'id' => 2,
            'user' => [
                'from' => 'America',
                'sex' => 'woman',
            ],
        ];
        $this->assertSame($expected, array_diff_key_recursive($other, $main));
    }
}
