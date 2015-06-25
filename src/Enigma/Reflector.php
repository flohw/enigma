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

        $this->checkWiring();
    }

    /**
     * Reflect an input letter
     *
     * @param string $letter
     *
     * @return string
     */
    public function reflect($letter)
    {
        $position = $this->charToInt($letter);

        return $this->wires[$position];
    }

    private function checkWiring()
    {
        foreach (range('A', 'Z') as $char) {
            if ($char !== $this->reflect($this->reflect($char))) {
                throw new \Exception(sprintf('%s => %s is not a legal reflection',
                  $char, $this->reflect($this->reflect($char))));
            }
        }
    }
}
