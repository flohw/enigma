<?php

namespace Enigma;

/**
 * Class Enigma
 *
 * @package Enigma
 */
class Enigma
{
    /**
     * @var Plugboard
     */
    private $pugboard;

    /**
     * @var Rotor[]
     */
    private $rotors;

    /**
     * @var Reflector
     */
    private $reflector;

    /**
     * Constructor
     *
     * @param Rotor[]        $rotors
     * @param null|Reflector $reflector
     * @param null|Plugboard $plugboard
     */
    public function __construct(array $rotors = array(), $reflector = null, $plugboard = null)
    {
    }
}
