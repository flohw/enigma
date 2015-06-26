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
    private $plugboard;

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
        foreach ($rotors as $rotor) {
            $this->addRotor($rotor);
        }
        $this->setReflector($reflector);
        $this->setPlugboard($plugboard);
    }

    public function input($string)
    {
        $length = strlen($string);
        $output  = '';

        for ($i = 0; $i < $length; $i++) {
            $char = $string[$i];
            $this->rotateRotors();


            $char = $this->plugboard->permute($char);
            foreach (array_reverse($this->rotors) as $rotor) {
                /** @var Rotor $rotor */
                $char = $rotor->encode($char);
            }

            $char = $this->reflector->reflect($char);

            foreach ($this->rotors as $rotor) {
                $char = $rotor->decode($char);
            }

            $char = $this->plugboard->permute($char);

            $output .= $char;
        }

        return $output;
    }

    /**
     * Add a rotor to the machine
     *
     * @param Rotor $rotor
     *
     * @return $this
     */
    public function addRotor(Rotor $rotor)
    {
        $this->rotors[] = $rotor;

        return $this;
    }

    /**
     * Set the machine's reflector
     *
     * @param Reflector $reflector
     *
     * @return $this
     */
    public function setReflector(Reflector $reflector = null)
    {
        if (null === $reflector) {
            $reflector = new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD');
        }

        $this->reflector = $reflector;

        return $this;
    }

    /**
     * Set the machine's plugboard
     *
     * @param Plugboard $plugboard
     *
     * @return $this
     */
    public function setPlugboard(Plugboard $plugboard = null)
    {
        if (null === $plugboard) {
            $plugboard = new Plugboard();
        }

        $this->plugboard = $plugboard;

        return $this;
    }

    private function rotateRotors()
    {
        $rotateNext = true;

        foreach (array_reverse($this->rotors) as $rotor) {
            /** @var Rotor $rotor */
            if (true === $rotateNext) {
                $rotor->rotate();
                $rotateNext = $rotor->isTurnover();
            }
        }
    }
}
