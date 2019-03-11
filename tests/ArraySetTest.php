<?php
declare(strict_types=1);

use Helper\TestBase;

final class ArraySetTest extends TestBase
{
    public function testSetValue()
    {
        $array = $this->array();
        array_set($array, ['user', 'name'], 'Jane');
        $this->assertSame('Jane', $array['user']['name']);

        $array = $this->array();
        array_set($array, 'user.name', 'Jane');
        $this->assertSame('Jane', $array['user']['name']);

        $array = $this->array();
        array_set($array, 'user_name', 'Jane', '_');
        $this->assertSame('Jane', $array['user']['name']);
    }

    public function testCreateDeepPath()
    {
        $array = [];
        array_set($array, 'user.name', 'Mike');
        $this->assertSame('Mike', $array['user']['name']);
    }

    private function array()
    {
        return [
            'user' => [
                'name' => 'Mike',
            ],
        ];
    }
}
