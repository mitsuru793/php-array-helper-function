<?php
declare(strict_types=1);

namespace Php;

final class ArrayDiffKeyTest extends ArrayDiffKeyTestBase
{
    protected function assertNoDiff($main, $other): void
    {
        $invalidKeys = array_diff_key($main, $other);
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
            'place' => 'America',
        ];
        $this->assertSame(['age' => 20], array_diff_key($main, $other));
        $this->assertSame(['place' => 'America'], array_diff_key($other, $main));
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
            'user' => [
                'name' => 'Jane',
                'place' => 'America',
            ],
        ];
        $this->assertNoDiff($main, $other);
        $this->assertNoDiff($other, $main);
    }
}
