<?php

namespace Enigma\Tests;

use Enigma\Reflector;

/**
 * Class ReflectorTest
 *
 * @package Enigma\Tests
 */
class ReflectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test reflection
     *
     * @covers Reflector::reflect
     */
    public function testReflect()
    {
        $reflector = new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD');

        $this->assertEquals('A', $reflector->reflect('E'));
        $this->assertEquals('A', $reflector->reflect($reflector->reflect('A')));
    }

    /**
     * Test reflect with an offset
     *
     * @covers Reflector::reflect
     */
    public function testReflectOffset()
    {
        $reflector = new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD');

        $this->assertEquals('A', $reflector->reflect('E'));
        $this->assertEquals('A', $reflector->reflect($reflector->reflect('A')));
    }
}
