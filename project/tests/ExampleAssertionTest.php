<?php


class ExampleAssertionTest extends \PHPUnit\Framework\TestCase
{
    public function testStringsMatch()
    {
        $string1 = 'test string';
        $string2 = 'test string';


        $this->assertSame($string1, $string2);
    }

}