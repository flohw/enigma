<?php

namespace Enigma;

use Enigma\Component\AbstractIndexedAlphabet;

/**
 * Class Reflector
 *
 * @package Enigma
 */
class Reflector extends AbstractIndexedAlphabet
{
    /**
     * @var string
     */
    private $wires;

    /**
     * Constructor
     *
     * @param string $wires
     *
     * @throws \Exception
     */
    public function __construct($wires)
    {
        $this->wires = $wires;
    }
}
