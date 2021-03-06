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
    public function __construct(array $rotors = [], $reflector = null, $plugboard = null)
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
        $countEncodedLetter = 0;

        for ($i = 0; $i < $length; $i++) {
            $rotateNext = true;
            if ($string[$i] == ' ') {
                continue;
            }

            $char = $string[$i];

            $char = $this->plugboard->permute($char);
            foreach (array_reverse($this->rotors) as $rotor) {
                /** @var Rotor $rotor */
                if (true === $rotateNext) {
                    $rotor->rotate();
                    $rotateNext = $rotor->isTurnover();
                }
                $char = $rotor->encode($char);
            }

            $char = $this->reflector->reflect($char);

            foreach ($this->rotors as $rotor) {
                $char = $rotor->decode($char);
            }

            $char = $this->plugboard->permute($char);
            $countEncodedLetter++;

            $output .= $char;
            if ($countEncodedLetter % 5 == 0) {
                $output .= ' ';
            }
        }

        return $output;
    }

    /**
     * Set rotor's initial position
     *
     * @param string $position
     * @throws \Exception
     *
     * @return $this
     */
    public function setRotorPosition($position)
    {
        $countRotors    = count($this->rotors);
        $positionLength = strlen($position);

        if ($positionLength !== $countRotors) {
            throw new \Exception(sprintf(
                'Initial position is invalid. %d positions defined, %d rotor present',
                $positionLength,
                $countRotors
            ));
        }

        foreach ($this->rotors as $k => $rotor) {
            /** @var Rotor $rotor */
            $rotor->setPosition($position[$k]);
        }

        return $this;
    }

    public function getRotorPosition()
    {
        $position = '';

        foreach ($this->rotors as $rotor) {
            /** @var Rotor $rotor */
            $position .= $rotor->getPosition();
        }

        return $position;
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

    /**
     * Count number of rotor in this enigma
     *
     * @return int
     */
    public function getRotorCount()
    {
        return count($this->rotors);
    }
}
