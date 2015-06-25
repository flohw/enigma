<?php

namespace Enigma\Tests;

use Enigma\Plugboard;

/**
 * Class PlugboardTests
 *
 * @package Enigma\Tests
 */
class PlugboardTests extends \PHPUnit_Framework_TestCase
{
    /**
     * Test permute method with an empty plugboard
     *
     * @covers Plugboard::permute
     */
    public function testPermuteEmptyBoard()
    {
        $plugboard = new Plugboard();

        $this->assertEquals('A', $plugboard->permute('A'));
    }

    /**
     * Test permute method with a plugboard filled
     *
     * @covers Plugboard::permute
     */
    public function testPermuteFilledBoard()
    {
        $plugboard = new Plugboard(array('a' => 't', 'j' => 'k'));

        $this->assertEquals('T', $plugboard->permute('a'));
        $this->assertEquals('Z', $plugboard->permute('z'));
    }

    /**
     * Test permute method when called a permuted value
     *
     * @covers Plugboard::permute
     */
    public function testDoublePermutatation()
    {
        $plugboard = new Plugboard(array('a' => 't', 'j' => 'k'));

        $this->assertEquals('A', $plugboard->permute($plugboard->permute('a')));
    }
}
