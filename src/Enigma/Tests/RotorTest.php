<?php

namespace Enigma\Tests;

use Enigma\Rotor;

/**
 * Class RotorTest
 *
 * @package Enigma\Tests
 */
class RotorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getPositionMethod
     *
     * @covers Rotor::getPosition
     */
    public function testPosition()
    {
        $rotor = new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'M');

        $this->assertEquals('M', $rotor->getPosition());
    }

    /**
     * Test position with rotate method
     *
     * @covers Rotor::getPosition
     */
    public function testPositionRotate()
    {
        $rotor = new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'M');

        $this->assertEquals('M', $rotor->getPosition());
        $rotor->rotate();
        $this->assertEquals('N', $rotor->getPosition());
    }

    /**
     * Test encode method
     *
     * @covers Rotor::encode
     */
    public function testEncode()
    {
        $rotor = new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'M');

        $this->assertEquals('C', $rotor->encode('M'));
        $this->assertEquals('E', $rotor->encode('O'));
    }

    /**
     * Test encode with rotate method
     *
     * @covers Rotor::encode
     * @covers Rotor::rotate
     */
    public function testEncodeRotate()
    {
        $rotor = new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'M');

        $this->assertEquals('C', $rotor->encode('M'));
        $rotor->rotate();
        $this->assertEquals('J', $rotor->encode('M'));
        $rotor->rotate();
        $this->assertEquals('E', $rotor->encode('M'));
    }

    /**
     * Test decode method
     *
     * @covers Rotor::decode
     */
    public function testDecode()
    {
        $rotor = new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'M');

        $this->assertEquals('Y', $rotor->decode('N'));
    }

    /**
     * Test decode with rotate method
     *
     * @covers Rotor::decode
     * @covers Rotor::rotate
     */
    public function testDecodeRotate()
    {
        $rotor = new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'M');

        $this->assertEquals('Y', $rotor->decode('N'));
        $rotor->rotate();
        $this->assertEquals('X', $rotor->decode('N'));
        $rotor->rotate();
        $rotor->rotate();
        $rotor->rotate();
        $this->assertEquals('U', $rotor->decode('N'));
    }
}
