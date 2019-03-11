<?php
declare(strict_types=1);


use Helper\TestBase;

final class ArrayUnsetTest extends TestBase
{
    public function testUnsetValue()
    {
        $array = $this->array();
        array_unset($array, ['user', 'name']);
        $this->assertEmpty($array['user']);

        $array = $this->array();
        array_unset($array, 'user.name');
        $this->assertEmpty($array['user']);

        $array = $this->array();
        array_unset($array, 'user_name', '_');
        $this->assertEmpty($array['user']);
    }

    public function testNotExistedPath()
    {
        $array = $this->array();
        array_unset($array, 'd1.d2');
        $this->assertSame($this->array(), $array);
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