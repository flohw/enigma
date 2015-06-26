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

        $this->assertEquals('GEDUWGKBIDOGKVDNX', $enigma1->input('MYXSECRETXMESSAGE'));
        $this->assertEquals('MYXSECRETXMESSAGE', $enigma2->input('GEDUWGKBIDOGKVDNX'));
    }

    /**
     * Test enigma encryption
     *
     * @covers Enigma::input
     */
    public function testInputWithNotch()
    {
        $enigma1 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'A'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'B', 'K' => 'P'))
        );
        $enigma2 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'A'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'B', 'K' => 'P'))
        );

        $this->assertEquals('FZYKJWOHZVOSUZKDH', $enigma1->input('MYXSECRETXMESSAGE'));
        $this->assertEquals('MYXSECRETXMESSAGE', $enigma2->input('FZYKJWOHZVOSUZKDH'));
    }

    /**
     * Test enigma encryption
     *
     * @covers Enigma::input
     */
    public function testInputWithTwoNotches()
    {
        $enigma1 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'Y'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'B', 'K' => 'P'))
        );
        $enigma2 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'Y'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'B', 'K' => 'P'))
        );

        $this->assertEquals('UGFZHULASUFLGXINW', $enigma1->input('MYXSECRETXMESSAGE'));
        $this->assertEquals('MYXSECRETXMESSAGE', $enigma2->input('UGFZHULASUFLGXINW'));
    }

    /**
     * Test enigma encryption
     *
     * @covers Enigma::input
     */
    public function testInputWithTwoNotchesBis()
    {
        $enigma1 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'Z'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'B', 'K' => 'P'))
        );
        $enigma2 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'Z'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'B', 'K' => 'P'))
        );

        $this->assertEquals('PQKYOXJGNUQMXDJMY', $enigma1->input('MYXSECRETXMESSAGE'));
        $this->assertEquals('MYXSECRETXMESSAGE', $enigma2->input('PQKYOXJGNUQMXDJMY'));
    }

    /**
     * Test enigma encryption
     *
     * @covers Enigma::input
     */
    public function testInputWithPlugboard()
    {
        $enigma1 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'Z'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'T', 'S' => 'J'))
        );
        $enigma2 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'Z'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'T', 'S' => 'J'))
        );

        $this->assertEquals('KQPHOXSGKUQMPNOMY', $enigma1->input('MYXSECRETXMESSAGE'));
        $this->assertEquals('MYXSECRETXMESSAGE', $enigma2->input('KQPHOXSGKUQMPNOMY'));
    }

    /**
     * Test enigma encryption
     *
     * @covers Enigma::input
     */
    public function testInputWithDifferentRotor()
    {
        $enigma1 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('VZBRGITYUPSDNHLXAWMJQOFECK', 'Z', 'A'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'T', 'S' => 'J'))
        );
        $enigma2 = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('VZBRGITYUPSDNHLXAWMJQOFECK', 'Z', 'A'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'T', 'S' => 'J'))
        );

        $this->assertEquals('NIHKNWQYSLNDRKNOQ', $enigma1->input('MYXSECRETXMESSAGE'));
        $this->assertEquals('MYXSECRETXMESSAGE', $enigma2->input('NIHKNWQYSLNDRKNOQ'));
    }

    /**
     * Test enigma encryption
     *
     * @covers Enigma::setRotorPosition
     */
    public function testInitialPosition()
    {
        $enigma = new Enigma(
            array(
                new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'),
                new Rotor('VZBRGITYUPSDNHLXAWMJQOFECK', 'Z', 'A'),
                new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'K')
            ),
            new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'),
            new Plugboard(array('A' => 'T', 'S' => 'J'))
        );

        $enigma->setRotorPosition('AAA');
        $this->assertEquals('AAA', $enigma->getRotorPosition());

        $enigma->setRotorPosition('AAK');
        $this->assertEquals('AAK', $enigma->getRotorPosition());
        $enigma->input('A');
        $this->assertEquals('ABL', $enigma->getRotorPosition());
    }
}
