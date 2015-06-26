<?php

namespace Enigma\Tests;

use Enigma\Enigma;
use Enigma\Plugboard;
use Enigma\Reflector;
use Enigma\Rotor;

/**
 * Class EnigmaTest
 *
 * @package Enigma\Tests
 */
class EnigmaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test enigma encryption
     *
     * @covers Enigma::input
     */
    public function testInput()
    {
        $enigma1 = new Enigma(
            array(
                        //'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'A'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'Z')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'B', 'K' => 'P'))
        );
        $enigma2 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'A'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'Z')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'B', 'K' => 'P'))
        );

        $this->assertEquals('LYQOJ', $enigma1->input('HELLO'));
        $this->assertEquals('HELLO', $enigma2->input('LYQOJ'));
    }
}
