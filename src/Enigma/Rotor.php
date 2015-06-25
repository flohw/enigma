<?php

namespace Enigma;

use Enigma\Component\AbstractIndexedAlphabet;

/**
 * Class Rotor
 *
 * @package Enigma
 */
class Rotor extends AbstractIndexedAlphabet
{
    /**
     * @var string[]
     */
    private $wiring;

    /**
     * @var string[]
     */
    private $notch;

    /**
     * @var int
     */
    private $position;

    /**
     * Constructor
     *
     * @param string $wiring
     * @param string $notch
     * @param string|int $position
     */
    public function __construct($wiring, $notch, $position)
    {
        $this->wiring = $wiring;
        $this->notch = $notch;
        $this->setPosition($position);
    }

    /**
     * Set rotor position
     *
     * @param string|int $position
     */
    public function setPosition($position)
    {
        if (!is_int($position)) {
            $position = $this->charToInt($position);
        }

        $position %= 26;

        while ($this->position !== $position) {
            $this->rotate();
        }
    }

    /**
     * Rotate the rotor
     */
    public function rotate()
    {
        $this->position = ($this->position + 1) % 26;
    }
}
